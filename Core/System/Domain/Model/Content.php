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

	/**
	 * Class Content
	 *
	 * @package Continut\Core\System\Domain\Model
	 * @Entity(repositoryClass="Continut\Core\System\Domain\Collection\ContentCollection")
	 * @Table(name="sys_content")
	 */
	class Content extends BaseModel {

		/**
		 * @var string value of the content element
		 *
		 * @Column(name="value", type="text")
		 */
		protected $value;

		/**
		 * @var string type of content element
		 *
		 * @Column(name="type", type="string")
		 */
		protected $type;

		/**
		 * @var int The uid of this element's parent
		 *
		 * @Column(type="integer", name="parent_id")
		 * @OneToOne(targetEntity="Content")
		 * @JoinColumn(name="parent_id", referencedColumnName="id")
		 */
		protected $parent;

		/**
		 * @var bool Is the content element visible?
		 *
		 * @Column(name="is_visible", type="boolean")
		 */
		protected $isVisible;

		/**
		 * @var bool Is the content element deleted?
		 *
		 * @Column(name="is_deleted", type="boolean")
		 */
		protected $isDeleted;

		/**
		 * @var int Column id
		 *
		 * @Column(name="column_id", type="integer")
		 */
		protected $columnId;

		/**
		 * @var \Continut\Core\System\Domain\Model\Page
		 *
		 * @Column(type="integer", name="page_id")
		 * @OneToOne(targetEntity="\Continut\Core\System\Domain\Model\Page")
		 * @JoinColumn(name="page_id", referencedColumnName="id")
		 */
		protected $page;

		/**
		 * @var int The reference id, if this is a reference content element
		 */
		protected $reference_id;

		/**
		 * @var int Field used for the sorting order of content elements
		 *
		 * @Column(name="sorting", type="integer")
		 */
		protected $sorting;

		/**
		 * @var \Continut\Core\Mvc\View\PageView Link to the parent PageView
		 */
		protected $_pageView;

		/**
		 * @var string
		 *
		 * @Column(name="title", type="string")
		 */
		protected $title;

		/**
		 * @return Content Get the parent of this content element
		 */
		public function getParent() {
			return $this->parent;
		}

		/**
		 * Set parent
		 *
		 * @param Content $parent
		 *
		 * @return Content
		 */
		public function setParent($parent) {
			$this->parent = $parent;

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
		 * @return Page
		 */
		public function getPage()
		{
			return $this->page;
		}

		/**
		 * @param int $page
		 *
		 * @return Content
		 */
		public function setPage($page)
		{
			$this->page = $page;

			return $this;
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
		 *
		 * @return Content
		 */
		public function setReferenceId($reference_id)
		{
			$this->reference_id = $reference_id;

			return $this;
		}

		/**
		 * @return int Get id of column where content is stored
		 */
		public function getColumnId() {
			return $this->columnId;
		}

		/**
		 * Set column id
		 *
		 * @param $columnId
		 *
		 * @return Content
		 */
		public function setColumnId($columnId) {
			$this->columnId = $columnId;

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
		 * @return Content
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
		 *
		 * @return Content
		 */
		public function setType($type) {
			$this->type = $type;

			return $this;
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
		 * Sets the element's serialized values
		 *
		 * @param string $value
		 *
		 * @return Content
		 */
		public function setValue($value) {
			$this->value = $value;

			return $this;
		}

		/**
		 * @return \Continut\Core\Mvc\View\PageViews
		 */
		public function getPageView() {
			return $this->_pageView;
		}

		/**
		 * @param $pageView
		 *
		 * @return Content
		 */
		public function setPageView($pageView) {
			$this->_pageView = $pageView;

			return $this;
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
		 * @return Content
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
		 * @return Content
		 */
		public function setIsDeleted($isDeleted)
		{
			$this->isDeleted = $isDeleted;

			return $this;
		}

		/**
		 * @param mixed $elements
		 */
		public function render($elements) {

		}
	}

}
