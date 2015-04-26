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

	use Core\Utility;

	class BackendContainer {
		/**
		 * @var array List of children elements added to container
		 */
		protected $_elements = [];

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
		 * @var string Container title
		 */
		protected $_title;

		protected $_uid;

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
		 * @return mixed
		 */

		public function getUid()
		{
			return $this->_uid;
		}

		/**
		 * @param mixed $uid
		 *
		 * @return $this
		 */
		public function setUid($uid)
		{
			$this->_uid = $uid;

			return $this;
		}

		/**
		 * @param string $title
		 *
		 * @return $this
		 */
		public function setTitle($title) {
			$this->_title = $title;

			return $this;
		}

		/**
		 * @return string
		 */
		public function getTitle() {
			return $this->_title;
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
		 * Assign the list of elements that this container must render
		 *
		 * @param $elements array
		 *
		 * @return $this
		 */
		public function setElements($elements) {
			$this->_elements = $elements;

			return $this;
		}

		/**
		 * Add content element to container
		 *
		 * @param $element
		 *
		 * @return $this
		 */
		public function addElement($element) {
			$this->_elements[$element->getUid()] = $element;

			return $this;
		}

		/**
		 * Show all content from a child container, can be called recursively inside other containers
		 *
		 * @param $id Id if the container to show
		 *
		 * @return string
		 */
		public function showContainerColumn($id) {
			$htmlElements = "";

			foreach ($this->getElements() as $element) {
				if ($element->getColumnId() == $id) {
					$htmlElements .= $element->render($element->children);
				}
			}

			return sprintf('<div data-parent="%s" data-id="%s" class="container-receiver">%s</div>', $this->getUid(), $id, $htmlElements);
		}

		/**
		 * Returns a localized label by its key
		 *
		 * @param string $labelKey
		 *
		 * @return string
		 */
		public function __($labelKey) {
			return Utility::helper("Localization")->translate($labelKey);
		}

	}

}
