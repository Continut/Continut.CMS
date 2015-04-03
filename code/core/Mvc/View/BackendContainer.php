<?php
/**
 * This file is part of the Conţinut CMS project.
 * Distributed under the GNU General Public License.
 * For more details, consult the LICENSE.txt file supplied with the project
 
 * Author: Radu Mogoş <radu.mogos@pixelplant.ch>
 * Date: 03.04.2015 @ 18:59
 * Project: Conţinut CMS
 */
namespace Core\Mvc\View {

	class BackendContainer {
		/**
		 * @var array List of elements added to container
		 */
		protected $_elements = [];

		/**
		 * @var array A container can have multiple subcontainers inside it
		 */
		protected $_containers = [];

		/**
		 * @var string Container template, if any
		 */
		protected $_template;

		public function __construct() {

		}

		public function setTemplate($template) {
			$this->_template = $template;
		}

		public function render() {
			ob_start();
			include($this->_template);
			return ob_get_clean();
		}

		public function getElements() {
			return $this->_elements;
		}

		public function addElement($element) {
			$this->_elements[$element->getUid()] = $element;
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
