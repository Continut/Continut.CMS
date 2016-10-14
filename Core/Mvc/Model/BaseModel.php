<?php
/**
 * This file is part of the Conţinut CMS project.
 * Distributed under the GNU General Public License.
 * For more details, consult the LICENSE.txt file supplied with the project
 * Author: Radu Mogoş <radu.mogos@pixelplant.ch>
 * Date: 29.03.2015 @ 18:43
 * Project: Conţinut CMS
 */

namespace Continut\Core\Mvc\Model;

use Continut\Core\Utility;

/**
 * Class BaseModel
 *
 * @package Continut\Core\Mvc\Model
 */
class BaseModel
{
    /**
     * @var int model unique identifier
     */
    protected $id;

    /**
     * @return int Model's unique id in the database
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id new id to use
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * Simple datamapper used for the database
     *
     * @return array
     */
    public function dataMapper()
    {
        return [
            "id" => $this->id
        ];
    }

    /**
     * Updates the values of this model
     *
     * @param array $values Array of key/value pairs to update the model with
     *
     * @return $this
     */
    public function update($values)
    {
        foreach ($values as $key => $value) {
            $modelProperty = Utility::toCamelCase($key);
            if (property_exists($this, $modelProperty)) {
                $method = "set" . ucfirst($modelProperty);
                $this->$method($value);
            }
        }

        return $this;
    }

    /**
     * Returns directly a value by property name
     *
     * @param $key
     *
     * @return mixed
     */
    public function fetchFromField($key)
    {
        if (property_exists($this, $key)) {
            $method = "get" . Utility::toCamelCase($key, TRUE);
            return $this->$method();
        }
        return null;
    }

    /**
     * Passes all column names to camelCase and forwards the data to the model
     *
     * @param array $data
     *
     * @return void
     */
    public function setDataFromDatabase($data) {
        foreach ($data as $fieldName => $fieldValue) {
            if (array_key_exists($fieldName, $this->dataMapper())) {
                $modelAttributeName = Utility::toCamelCase($fieldName);
                $this->$modelAttributeName = $fieldValue;
            }
        }
    }
}
