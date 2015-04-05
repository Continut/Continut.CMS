<?php
/**
 * This file is part of the Conţinut CMS project.
 * Distributed under the GNU General Public License.
 * For more details, consult the LICENSE.txt file supplied with the project
 
 * Author: Radu Mogoş <radu.mogos@pixelplant.ch>
 * Date: 03.04.2015 @ 18:55
 * Project: Conţinut CMS
 */
namespace Core\Mvc\View {

	class BaseLayout {
		/**
		 * @var string Layout template to use
		 */
		protected $_template;

		/**
		 * @var array List of containers defined for this layout
		 */
		protected $_containers;

		/**
		 * @var PageView the Pageview this layout is linked to
		 */
		protected $_page = NULL;

		/**
		 * @param string $template Set layout template file
		 */
		public function setTemplate($template) {
			$this->_template = $template;
		}

		/**
		 * @return string
		 */
		public function getTemplate() {
			return $this->_template;
		}

		/**
		 * @param PageView $page Set the PageView this layout belongs to
		 */
		public function setPage($page) {
			$this->_page = $page;
		}

		/**
		 * @return PageView
		 */
		public function getPage() {
			return $this->_page;
		}

		/**
		 * @param array $containers List of BackendContainer objects
		 */
		public function setContainers($containers) {
			$this->_containers = $containers;
			/*foreach ($this->_containers as $container) {
				$container->setLayout($this);
			}*/
		}

		/**
		 * @return array List of containers for this layout
		 */
		public function getContainers() {
			return $this->_containers;
		}

		/**
		 * Render layout
		 *
		 * @return string
		 */
		public function render() {
			ob_start();
			include_once $this->_template;
			return ob_get_clean();
		}

		/**
		 * @param string $partial Renders a partial
		 *
		 * @return string
		 */
		public function renderPartial($partial) {
			echo "Partials not yet implemented :)";
		}

		/**
		 * Show all content from a container
		 *
		 * @param $id Id if the container to show
		 */
		public function showContainerId($id) {
			$htmlElements = "";
			if (isset($this->_containers[$id])) {
				foreach ($this->_containers[$id]->getElements() as $element) {
					$htmlElements .= $element->render();
				}
			}
			echo "Container $id ".$htmlElements;
		}
	}

}
