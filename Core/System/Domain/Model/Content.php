<?php
/**
 * This file is part of the Conţinut CMS project.
 * Distributed under the GNU General Public License.
 * For more details, consult the LICENSE.txt file supplied with the project
 * Author: Radu Mogoş <radu.mogos@pixelplant.ch>
 * Date: 03.04.2015 @ 20:38
 * Project: Conţinut CMS
 */

namespace Continut\Core\System\Domain\Model;

use Continut\Core\Mvc\Model\BaseModel;

class Content extends BaseModel
{
    /**
     * @var string value of the content element
     */
    protected $value;

    /**
     * @var string type of content element
     */
    protected $type;

    /**
     * @var int The id of this element's parent
     */
    protected $parentId;

    /**
     * @var bool Is the content element visible?
     */
    protected $isVisible;

    /**
     * @var bool Is the content element deleted?
     */
    protected $isDeleted;

    /**
     * @var int Column id
     */
    protected $columnId;

    /**
     * @var int Id of the page where the element is stored
     */
    protected $pageId;

    /**
     * @var int The reference id, if this is a reference content element
     */
    protected $referenceId;

    /**
     * @var int Field used for the sorting order of content elements
     */
    protected $sorting;

    /**
     * @var \Continut\Core\Mvc\View\PageView Link to the parent PageView
     */
    protected $pageView;

    /**
     * @var string
     */
    protected $title;

    /**
     * @var int Creation date+time (unix timestamp)
     */
    protected $createdAt;

    /**
     * @var int Last modified date+time (unix timestamp)
     */
    protected $modifiedAt;

    /**
     * Datamapper for this model
     *
     * @return array
     */
    public function dataMapper()
    {
        $fields = [
            "page_id"     => $this->pageId,
            "type"        => $this->type,
            "title"       => $this->title,
            "column_id"   => $this->columnId,
            "parent_id"   => $this->parentId,
            "value"       => $this->value,
            "is_deleted"  => $this->isDeleted,
            "is_visible"  => $this->isVisible,
            "sorting"     => $this->sorting,
            "modified_at" => $this->modifiedAt,
            "created_at"  => $this->createdAt
        ];
        return array_merge($fields, parent::dataMapper());
    }

    /**
     * @return int Get the parent id of this content element
     */
    public function getParentId()
    {
        return $this->parentId;
    }

    /**
     * Set parent id
     *
     * @param int $parentId
     *
     * @return $this
     */
    public function setParentId($parentId)
    {
        $this->parentId = $parentId;

        return $this;
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
     *
     * @return $this
     */
    public function setSorting($sorting)
    {
        $this->sorting = $sorting;

        return $this;
    }

    /**
     * @return int
     */
    public function getReferenceId()
    {
        return $this->referenceId;
    }

    /**
     * @param int $referenceId
     *
     * @return $this
     */
    public function setReferenceid($referenceId)
    {
        $this->referenceId = $referenceId;

        return $this;
    }

    /**
     * @return int Get id of column where content is stored
     */
    public function getColumnId()
    {
        return $this->columnId;
    }

    /**
     * Set column id
     *
     * @param $columnId
     *
     * @return $this
     */
    public function setColumnId($columnId)
    {
        $this->columnId = $columnId;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param $title
     *
     * @return $this
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Gets the element's serialized values. Do a json_decode after retrieving them
     *
     * @return string
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Sets the element's serialized values
     *
     * @param string $value
     *
     * @return $this
     */
    public function setValue($value)
    {
        $this->value = $value;

        return $this;
    }

    /**
     * @param $pageView
     *
     * @return $this
     */
    public function setPageView($pageView)
    {
        $this->pageView = $pageView;

        return $this;
    }

    /**
     * @return \Continut\Core\Mvc\View\PageView
     */
    public function getPage()
    {
        return $this->pageView;
    }

    /**
     * @return mixed
     */
    public function getIsVisible()
    {
        return $this->isVisible;
    }

    /**
     * @param mixed $isVisible
     *
     * @return $this
     */
    public function setIsVisible($isVisible)
    {
        $this->isVisible = $isVisible;

        return $this;
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
     *
     * @return $this
     */
    public function setIsDeleted($isDeleted)
    {
        $this->isDeleted = $isDeleted;

        return $this;
    }

    /**
     * @param mixed $elements
     */
    public function render($elements)
    {

    }

    /**
     * Generated the data-continut-cms-* properties for frontend editing
     *
     * @return string
     */
    public function frontendEditor()
    {
        return sprintf('data-continut-cms-id="%s" data-continut-cms-type="%s" data-continut-cms-page="%s"',
            $this->getId(),
            $this->getType(),
            $this->getPageId()
        );
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
     *
     * @return $this
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return int
     */
    public function getPageId()
    {
        return $this->pageId;
    }

    /**
     * @param int $pageId
     *
     * @return $this
     */
    public function setPageId($pageId)
    {
        $this->pageId = $pageId;

        return $this;
    }

    /**
     * @return int
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @param int $createdAt
     *
     * @return $this
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * @return int
     */
    public function getModifiedAt()
    {
        return $this->modifiedAt;
    }

    /**
     * @param int $modifiedAt
     *
     * @return $this
     */
    public function setModifiedAt($modifiedAt)
    {
        $this->modifiedAt = $modifiedAt;

        return $this;
    }
}
