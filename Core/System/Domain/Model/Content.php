<?php
/**
 * This file is part of the Conţinut CMS project.
 * Distributed under the GNU General Public License.
 * For more details, consult the LICENSE.txt file supplied with the project
 
 * Author: Radu Mogoş <radu.mogos@pixelplant.ch>
 * Date: 03.04.2015 @ 20:38
 * Project: Conţinut CMS
 */
namespace Core\System\Domain\Model {
	use Core\Mvc\Model\BaseModel;
	use \Core\Utility;

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
		 * @var int The uid of this element's parent
		 */
		protected $parent_uid;

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
		protected $page_uid;

		/**
		 * @var int The reference uid, if this is a reference content element
		 */
		protected $reference_uid;

		/**
		 * @var int Field used for the sorting order of content elements
		 */
		protected $sorting;

		/**
		 * @var \Core\Mvc\View\PageView Link to the parent PageView
		 */
		protected $_pageView;

		/**
		 * Datamapper for this model
		 *
		 * @return array
		 */
		public function dataMapper() {
			return [
				"page_uid"    => $this->page_uid,
				"type"        => $this->type,
				"title"       => $this->title,
				"column_id"      => $this->column_id,
				"parent_uid"  => $this->parent_uid,
				"value"       => $this->value,
				"is_deleted"  => $this->is_deleted,
				"is_visible"  => $this->is_visible,
				"sorting"     => $this->sorting
			];
		}

		/**
		 * @return int Get the parent id of this content element
		 */
		public function getParentUid() {
			return $this->parent_uid;
		}

		/**
		 * Set parent uid
		 *
		 * @param int $parentUid
		 *
		 * @return $this
		 */
		public function setParentUid($parentUid) {
			$this->parent_uid = $parentUid;

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
		public function getPageUid()
		{
			return $this->page_uid;
		}

		/**
		 * @param int $page_uid
		 */
		public function setPageUid($page_uid)
		{
			$this->page_uid = $page_uid;
		}

		/**
		 * @return int
		 */
		public function getReferenceUid()
		{
			return $this->reference_uid;
		}

		/**
		 * @param int $reference_uid
		 */
		public function setReferenceUid($reference_uid)
		{
			$this->reference_uid = $reference_uid;
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
		 * @return \Core\Mvc\View\PageViews
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
		 * Render the current element and optinally pass the children elements to render for containers
		 *
		 * @param $elements Children elements to render, only for containers
		 *
		 * @return mixed|string
		 */
		public function render($elements) {
			$value = "";
			switch ($this->getType()) {
				case "content"   : $value = $this->getContentValue(); break;
				case "plugin"    : $value = $this->getPluginValue(); break;
				case "reference" : $value = $this->getReferenceValue(); break;
				// container is a special case and it can render elements recursively
				case "container" : $value = $this->getContainerValue($elements); break;
			}
			return $value;
		}

		/**
		 * Outputs "regular" content, of type "content" in the database
		 *
		 * @return string
		 */
		public function getContentValue() {
			$configuration = json_decode($this->getValue(), TRUE);

			$variables = $configuration["content"]["data"];
			// we overwrite the title, if such a variable exists, with the value of the column "title" in the content table
			$variables["title"] = $this->getTitle();

			$view = Utility::createInstance("Core\\Mvc\\View\\BaseView");
			$view->setTemplate(Utility::getResource(
				$configuration["content"]["template"],
				$configuration["content"]["extension"],
				"Frontend",
				"Content"
			));
			$view->assignMultiple($variables);

			return $view->render();
		}

		/**
		 * Outputs "plugin" content
		 *
		 * @return string The output of the plugin call
		 * @throws \Core\Tools\Exception
		 */
		public function getPluginValue() {
			$configuration = json_decode($this->getValue(), TRUE);

			return Utility::callPlugin(
				$configuration["plugin"]["extension"],
				$configuration["plugin"]["controller"],
				$configuration["plugin"]["action"],
				$configuration["plugin"]["settings"]
				);
		}

		public function getReferenceValue() {
			$reference = (int)$this->getReferenceUid();
			$value = "";
			if ($reference > 0) {
				// Load the content collection model and then find all the content elements that belong to this page_uid
				$contentCollection = Utility::createInstance("\\Extensions\\System\\Frontend\\Classes\\Domain\\Collection\\FrontendContentCollection");
				$referencedContent = $contentCollection
					->where("is_deleted = 0 AND uid = :uid ORDER BY sorting ASC", [":uid" => $reference])
					->getFirst();
				// set the element's id to the reference id, so that we do not modify the original
				$referencedContent->setUid($this->getUid());
				if ($referencedContent) {
					if ($referencedContent->getType() != "container") {
						$value = $referencedContent->render(null);
					} else {
						$contentCollection
							->where("page_uid = :page_uid", ["page_uid" => $referencedContent->getPageUid()]);
						$elements = $contentCollection->findChildrenForUid($reference);
						$value = $referencedContent->render($elements->children);
					}
				}
			}
			return $value;
		}

		/**
		 * Outputs "container" content
		 *
		 * @param $elements Chidren elements to render
		 *
		 * @return mixed
		 * @throws \Core\Tools\Exception
		 */
		public function getContainerValue($elements) {
			$configuration = json_decode($this->getValue(), TRUE);
			$variables = $configuration["container"]["data"];

			$container = Utility::createInstance("\\Core\\Mvc\\View\\Container");
			$container->setUid($this->getUid());
			$container->setElements($elements);
			$container->setTemplate(
				Utility::getResource(
					$configuration["container"]["template"],
					$configuration["container"]["extension"],
					"Frontend",
					"Container"
					)
			);
			$container->assignMultiple($variables);
			return $container->render();
		}
	}

}
