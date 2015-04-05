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

		/**
		 * A container belongs to a layout
		 *
		 * @var BaseLayout
		 */
		protected $_layout;

		/**
		 * @param BaseLayout $layout
		 */
		public function setLayout($layout) {
			$this->_layout = $layout;
		}

		/**
		 * @return BaseLayout
		 */
		public function getLayout() {
			return $this->_layout;
		}

		/**
		 * Set container template name
		 *
		 * @param string $template
		 */
		public function setTemplate($template) {
			$this->_template = $template;
		}

		/**
		 * Render container template
		 *
		 * @return string
		 */
		public function render() {
			ob_start();
			include($this->_template);
			return ob_get_clean();
		}

		/**
		 * Get container elements
		 *
		 * @return array
		 */
		public function getElements() {
			return $this->_elements;
		}

		/**
		 * Add content element to container
		 *
		 * @param $element
		 */
		public function addElement($element) {
			$this->_elements[$element->getUid()] = $element;
		}

		/**
		 * Show all content from a child container, can be called recursively inside other containers
		 *
		 * @param $id Id if the container to show
		 */
		public function showContainerId($id) {
			$this->getLayout()->showContainerId($id);
		}

	}

}
