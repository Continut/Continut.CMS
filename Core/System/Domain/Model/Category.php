<?php
/**
 * This file is part of the Conţinut CMS project.
 * Distributed under the GNU General Public License.
 * For more details, consult the LICENSE.txt file supplied with the project
 * Author: Radu Mogoş <radu.mogos@pixelplant.ch>
 * Date: 07.04.2015 @ 22:46
 * Project: Conţinut CMS
 */
namespace Continut\Core\System\Domain\Model;

use Continut\Core\Mvc\Model\BaseModel;
use Continut\Core\Utility;

class Category extends BaseModel
{
    /**
     * @var int
     */
    protected $parentId;

    /**
     * @var boolean
     */
    protected $isVisible;

    /**
     * @var boolean
     */
    protected $isDeleted;

    /**
     * @var int
     */
    protected $sorting;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $values;

    /**
     * @var string
     */
    protected $type;

    /**
     * Simple datamapper used for the database
     *
     * @return array
     */
    public function dataMapper()
    {
        $fields = [
            "name"       => $this->name,
            "is_visible" => $this->isVisible,
            "is_deleted" => $this->isDeleted,
            "parent_id"  => $this->parentId,
            "sorting"    => $this->sorting,
            "type"       => $this->type,
            "values"     => $this->values
        ];
        return array_merge($fields, parent::dataMapper());
    }

    /**
     * @return int
     */
    public function getParentId()
    {
        return $this->parentId;
    }

    /**
     * @param int $parentId
     */
    public function setParentId($parentId)
    {
        $this->parentId = $parentId;
    }

    /**
     * @return boolean
     */
    public function getIsVisible()
    {
        return $this->isVisible;
    }

    /**
     * @param boolean $isVisible
     */
    public function setIsVisible($isVisible)
    {
        $this->isVisible = $isVisible;
    }

    /**
     * @return boolean
     */
    public function getIsDeleted()
    {
        return $this->isDeleted;
    }

    /**
     * @param boolean $isDeleted
     */
    public function setIsDeleted($isDeleted)
    {
        $this->isDeleted = $isDeleted;
    }

    /**
     * @return int
     */
    public function getSorting()
    {
        return $this->sorting;
    }

    /**
     * @param int $sorting
     */
    public function setSorting($sorting)
    {
        $this->sorting = $sorting;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getValues()
    {
        return $this->values;
    }

    /**
     * @param string $values
     */
    public function setValues($values)
    {
        $this->values = $values;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param string $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }
}
