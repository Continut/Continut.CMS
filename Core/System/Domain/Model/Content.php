<?php
/**
 * This file is part of the Conţinut CMS project.
 * Distributed under the GNU General Public License.
 * For more details, consult the LICENSE.txt file supplied with the project
 
 * Author: Radu Mogoş <radu.mogos@pixelplant.ch>
 * Date: 03.04.2015 @ 20:38
 * Project: Conţinut CMS
 */
namespace Continut\Core\System\Domain\Model {

	use Continut\Core\Mvc\Model\BaseModel;

	class Content extends BaseModel {

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
		protected $parent_id;

		/**
		 * @var bool Is the content element visible?
		 */
		protected $is_visible;

		/**
		 * @var bool Is the content element deleted?
		 */
		protected $is_deleted;

		/**
		 * @var int Column id
		 */
		protected $column_id;

		/**
		 * @var int Id of the page where the element is stored
		 */
		protected $page_id;

		/**
		 * @var int The reference id, if this is a reference content element
		 */
		protected $reference_id;

		/**
		 * @var int Field used for the sorting order of content elements
		 */
		protected $sorting;

		/**
		 * @var \Continut\Core\Mvc\View\PageView Link to the parent PageView
		 */
		protected $_pageView;

		/**
		 * @var string
		 */
		protected $title;

		/**
		 * Datamapper for this model
		 *
		 * @return array
		 */
		public function dataMapper() {
			return [
				"page_id"    => $this->page_id,
				"type"        => $this->type,
				"title"       => $this->title,
				"column_id"      => $this->column_id,
				"parent_id"  => $this->parent_id,
				"value"       => $this->value,
				"is_deleted"  => $this->is_deleted,
				"is_visible"  => $this->is_visible,
				"sorting"     => $this->sorting
			];
		}

		/**
		 * @return int Get the parent id of this content element
		 */
		public function getParentId() {
			return $this->parent_id;
		}

		/**
		 * Set parent id
		 *
		 * @param int $parentId
		 *
		 * @return $this
		 */
		public function setParentId($parentId) {
			$this->parent_id = $parentId;

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
		 */
		public function setSorting($sorting)
		{
			$this->sorting = $sorting;
		}

		/**
		 * @return int
		 */
		public function getPageId()
		{
			return $this->page_id;
		}

		/**
		 * @param int $page_id
		 */
		public function setPageId($page_id)
		{
			$this->page_id = $page_id;
		}

		/**
		 * @return int
		 */
		public function getReferenceId()
		{
			return $this->reference_id;
		}

		/**
		 * @param int $reference_id
		 */
		public function setReferenceid($reference_id)
		{
			$this->reference_id = $reference_id;
		}

		/**
		 * @return int Get id of column where content is stored
		 */
		public function getColumnId() {
			return $this->column_id;
		}

		/**
		 * Set column id
		 *
		 * @param $columnId
		 *
		 * @return $this
		 */
		public function setColumnId($columnId) {
			$this->column_id = $columnId;

			return $this;
		}

		/**
		 * @return mixed
		 */
		public function getTitle() {
			return $this->title;
		}

		/**
		 * @param $title
		 *
		 * @return $this
		 */
		public function setTitle($title) {
			$this->title = $title;

			return $this;
		}

		/**
		 * @return string
		 */
		public function getType() {
			return $this->type;
		}

		/**
		 * @param string $type
		 */
		public function setType($type) {
			$this->type = $type;
		}

		/**
		 * Sets the element's serialized values
		 *
		 * @param string $value
		 */
		public function setValue($value) {
			$this->value = $value;
		}

		/**
		 * Gets the element's serialized values. Do a json_decode after retrieving them
		 *
		 * @return string
		 */
		public function getValue() {
			return $this->value;
		}

		/**
		 * @param $pageView
		 */
		public function setPageView($pageView) {
			$this->_pageView = $pageView;
		}

		/**
		 * @return \Continut\Core\Mvc\View\PageViews
		 */
		public function getPage() {
			return $this->_pageView;
		}

		/**
		 * @return mixed
		 */
		public function getIsVisible()
		{
			return $this->is_visible;
		}

		/**
		 * @param mixed $is_visible
		 */
		public function setIsVisible($is_visible)
		{
			$this->is_visible = $is_visible;
		}

		/**
		 * @return boolean
		 */
		public function isIsDeleted()
		{
			return $this->is_deleted;
		}

		/**
		 * @param boolean $is_deleted
		 */
		public function setIsDeleted($is_deleted)
		{
			$this->is_deleted = $is_deleted;
		}

		/**
		 * @param mixed $elements
		 */
		public function render($elements) {

		}
	}

}
