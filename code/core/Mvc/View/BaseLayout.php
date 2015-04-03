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
		 * @param string $template Set layout template file
		 */
		public function setTemplate($template) {
			$this->_template = $template;
		}

		/**
		 * @param array $containers List of BackendContainer objects
		 */
		public function setContainers($containers) {
			$this->_containers = $containers;
		}

		/**
		 * Render layout
		 *
		 * @return string
		 */
		public function render() {
			include_once $this->_template;
			return ob_get_contents();
		}

		/**
		 * @param string $partial Renders a partial
		 *
		 * @return string
		 */
		public function renderPartial($partial) {
			echo "Needs to be implemented :)";
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
