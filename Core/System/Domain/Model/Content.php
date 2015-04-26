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
		 * @var \Core\Mvc\View\PageView Link to the parent PageView
		 */
		protected $_page;

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

		public function getType() {
			return $this->type;
		}

		public function getValue() {
			return $this->value;
		}

		/**
		 * @param $page
		 */
		public function setPage($page) {
			$this->_page = $page;
		}

		/**
		 * @return \Core\Mvc\View\PageViews
		 */
		public function getPage() {
			return $this->_page;
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
			$title = $this->getTitle();
			if (!empty($title)) {
				$title = "<h2>$title</h2>";
			}
			return $title . $this->getValue();
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

			$container = Utility::createInstance("\\Core\\Mvc\\View\\BackendContainer");
			$container->setUid($this->getUid());
			//$container->setLayout($this->getPage()->getLayout());
			$container->setElements($elements);
			$container->setTemplate(
				Utility::getResource(
					$configuration["container"]["template"],
					$configuration["container"]["extension"],
					"Frontend",
					"Container"
					)
			);
			return $container->render();
		}
	}

}
