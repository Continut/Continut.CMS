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

		protected $value;

		protected $type;

		protected $parent_uid;

		/**
		 * @var \Core\Mvc\View\PageView Link to the parent PageView
		 */
		protected $_page;

		/**
		 * @return int Get the parent id of this content element
		 */
		public function getParentUid() {
			return $this->parent_uid;
		}

		/**
		 * @return int Get id of column where content is stored
		 */
		public function getColumn() {
			return $this->column;
		}

		public function getTitle() {
			return $this->title;
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
