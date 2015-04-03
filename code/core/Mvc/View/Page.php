<?php
/**
 * This file is part of the Conţinut CMS project.
 * Distributed under the GNU General Public License.
 * For more details, consult the LICENSE.txt file supplied with the project
 
 * Author: Radu Mogoş <radu.mogos@pixelplant.ch>
 * Date: 03.04.2015 @ 19:12
 * Project: Conţinut CMS
 */
namespace Core\Mvc\View {
	use \Core\Mvc\Model\BaseModel;
	use Core\Utility;

	class Page extends BaseModel {
		/**
		 * @var \Core\Mvc\View\BaseLayout Layout used by this page
		 */
		protected $_layout;

		public function setTablename() {
			$this->_tablename = "sys_pages";
		}

		/**
		 * @param \Core\Mvc\View\BaseLayout $layout Set page layout
		 */
		public function setLayout($layout) {
			$this->_layout = $layout;
			$content = Utility::createInstance("\\Core\\Mvc\\Model\\Content");
			$content1 = $content->findByUid(1);
			$content2 = $content->findByUid(3);
			$container = Utility::createInstance("\\Core\\Mvc\\View\\BackendContainer");
			$container->addElement($content1);
			$container->addElement($content2);
			$this->_layout->setContainers([1 => $container, 3 => $container]);
		}

		public function render() {
			return $this->_layout->render();
		}
	}

}
