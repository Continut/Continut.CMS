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
	use Core\Utility;

	class PageView {
		/**
		 * @var \Core\Mvc\View\BaseLayout Layout used by this page
		 */
		protected $_layout;

		/**
		 * @var array List of JavaScript assets to include
		 */
		protected $_jsAssets;

		/**
		 * @var array List of Css assets to include
		 */
		protected $_cssAssets;

		/**
		 * @param \Core\Mvc\View\BaseLayout $layout Set page layout
		 *
		 * @return $this
		 */
		public function setLayout($layout) {
			$this->_layout = $layout;
			$this->_layout->setPage($this);

			return $this;
			/*$content = Utility::createInstance("\\Core\\System\\Domain\\Model\\Content");
			$content1 = $content->findByUid(1);
			$content2 = $content->findByUid(3);
			$container = Utility::createInstance("\\Core\\Mvc\\View\\BackendContainer");
			$container->addElement($content1);
			$container->addElement($content2);
			$this->_layout->setContainers([1 => $container, 3 => $container]);*/
		}

		public function getLayout() {
			return $this->_layout;
		}

		public function render() {
			return $this->_layout->render();
		}

		public function getJsAssets() {
			return $this->_jsAssets;
		}

		public function getCssAssets() {
			return $this->_cssAssets;
		}

		public function addJsAsset($name, $file) {
			$this->_jsAssets[$name] = $file;
		}

		public function addCssAsset($name, $file) {
			$this->_cssAssets[$name] = $file;
		}
	}

}
