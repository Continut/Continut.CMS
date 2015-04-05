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

		/**
		 * @var \Core\Mvc\View\PageView Link to the parent PageView
		 */
		protected $_page;

		public function __construct() {
			$this->_tablename = "sys_content";
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

		public function render() {
			$value = "";
			switch ($this->getType()) {
				case "content"   : $value = $this->getValue(); break;
				case "plugin"    : $value = $this->getPluginValue(); break;
				case "container" : $value = $this->getContainerValue(); break;
			}
			return $value;
		}

		public function getPluginValue() {
			$configuration = json_decode($this->getValue(), TRUE);

			return Utility::callPlugin(
				$configuration["plugin"]["extension"],
				$configuration["plugin"]["controller"],
				$configuration["plugin"]["action"],
				$configuration["plugin"]["settings"]
				);
		}

		public function getContainerValue() {
			$configuration = json_decode($this->getValue(), TRUE);

			$container = Utility::createInstance("\\Core\\Mvc\\View\\BackendContainer");
			$container->setLayout($this->getPage()->getLayout());
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

		public function getType() {
			return $this->type;
		}

		public function getValue() {
			return $this->value;
		}
	}

}
