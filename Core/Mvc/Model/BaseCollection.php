<?php
/**
 * This file is part of the Conţinut CMS project.
 * Distributed under the GNU General Public License.
 * For more details, consult the LICENSE.txt file supplied with the project
 * Author: Radu Mogoş <radu.mogos@pixelplant.ch>
 * Date: 04.04.2015 @ 11:54
 * Project: Conţinut CMS
 */
namespace Continut\Core\Mvc\Model;

use Continut\Core\Utility;

class BaseCollection
{
    /**
     * @var string Tablename to use for collection
     */
    protected $tablename;

    /**
     * @var string Class of each element
     */
    protected $elementClass = "";

    /**
     * @var array List of elements held by this collection
     */
    protected $elements = [];

    /**
     * Get all elements from the collection
     *
     * @return array
     */
    public function getAll()
    {
        return $this->elements;
    }

    /**
     * Get first element from the collection
     *
     * @return null
     */
    public function getFirst()
    {
        if (!empty($this->elements)) {
            return $this->elements[0];
        }
        return NULL;
    }

    /**
     * Manually remove an element
     *
     * @param $elementToRemove
     *
     * @return $this
     */
    public function remove($elementToRemove)
    {
        foreach ($this->elements as $element) {
            if ($element === $elementToRemove) {
                unset($this->elements[$element]);
            }
        }

        return $this;
    }

    /**
     * Empty the collection
     *
     * @return $this
     */
    public function reset()
    {
        $this->elements = [];

        return $this;
    }

    /**
     * Execute a custom sql query while returning elements of the same class the repository represents
     *
     * @param string $sql
     * @param array  $values
     *
     * @return $this
     */
    public function sql($sql, $values = [])
    {
        $this->elements = [];
        $sth = Utility::getDatabase()->prepare($sql);

        $sth->execute($values);
        while ($row = $sth->fetch(\PDO::FETCH_ASSOC)) {
            $element = Utility::createInstance($this->elementClass);
            $element->setDataFromDatabase($row);
            $this->add($element);
        }

        return $this;
    }

    /**
     * Manually add an element
     *
     * @param $element
     *
     * @return $this
     */
    public function add($element)
    {
        $this->elements[] = $element;
        return $this;
    }

    /**
     * @param string $conditions
     * @param array  $values
     *
     * @return string
     */
    public function whereCount($conditions, $values = [])
    {
        $sth = Utility::getDatabase()->prepare("SELECT COUNT(*) FROM $this->tablename WHERE " . $conditions);
        $sth->execute($values);
        return $sth->fetchColumn();
    }

    /**
     * Return 1 record by id
     *
     * @param $id
     *
     * @return mixed
     */
    public function findById($id)
    {
        $sth = Utility::getDatabase()->prepare("SELECT * FROM $this->tablename WHERE id = :id");
        $sth->execute(["id" => $id]);

        $row = $sth->fetch(\PDO::FETCH_ASSOC);
        $element = Utility::createInstance($this->elementClass);
        $element->setDataFromDatabase($row);
        $this->elements = [$element];

        return $element;
    }

    /**
     * General method used to find by a certain column, eg: findById, findByName, findByIsDeleted
     * @param $method
     * @param $args
     * @return BaseCollection
     */
    public function __call($method, $args)
    {
        if (substr($method, 0, 6) == "findBy" && strlen($method) > 6) {
            $field = lcfirst(substr($method, 6));
            // so far we only map 1 field, to be enhanced to more (AND, OR conditions)
            $values = [$field => $args[0]];
            $conditions = "$field = :$field";
            return $this->where($conditions, $values);
        }
    }

    /**
     * Do a where on the collection
     *
     * @param string $conditions
     * @param array  $values
     *
     * @return $this
     */
    public function where($conditions, $values = [])
    {
        $this->elements = [];
        $sth = Utility::getDatabase()->prepare("SELECT * FROM $this->tablename WHERE " . $conditions);
        $sth->execute($values);

        while ($row = $sth->fetch(\PDO::FETCH_ASSOC)) {
            $element = Utility::createInstance($this->elementClass);
            $element->setDataFromDatabase($row);
            $this->add($element);
        }

        return $this;
    }

    /**
     * Save all the collection elements
     *
     * @return $this
     */
    public function save()
    {
        foreach ($this->elements as $element) {
            $dataMapper = $element->dataMapper();
            $listOfFields = implode(",", array_keys($dataMapper));
            $listOfValues = [];
            // element does not exist, insert it
            if (is_null($element->getId())) {
                foreach ($dataMapper as $key => $value) {
                    $listOfValues[] = ":" . $key;
                }
                $listOfValues = implode(",", $listOfValues);
                $sth = Utility::getDatabase()->prepare("INSERT INTO $this->tablename ($listOfFields) VALUES ($listOfValues)");
                // element exists, update it
            } else {
                foreach ($dataMapper as $key => $value) {
                    $listOfValues[] = $key . "= :" . $key;
                }
                $listOfValues = implode(",", $listOfValues);
                $sth = Utility::getDatabase()->prepare("UPDATE $this->tablename SET $listOfValues WHERE id = :id");
                $dataMapper["id"] = $element->getId();
            }
            $sth->execute($dataMapper);
        }

        return $this;
    }

    public function delete()
    {
        foreach ($this->elements as $element) {
            if (!is_null($element->getId)) {
                $sth = Utility::getDatabase()->prepare("DELETE FROM $this->tablename WHERE id = :id");
                $sth->execute(["id" => $element->getId()]);
            }
        }
    }

    /**
     * How many elements do we have in the collection?
     *
     * @return int
     */
    public function count()
    {
        return sizeof($this->elements);
    }

    /**
     * @return boolean
     */
    public function isEmpty()
    {
        return (sizeof($this->elements) == 0);
    }
}
