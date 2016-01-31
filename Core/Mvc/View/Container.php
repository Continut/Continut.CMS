<?php
/**
 * This file is part of the Conţinut CMS project.
 * Distributed under the GNU General Public License.
 * For more details, consult the LICENSE.txt file supplied with the project
 
 * Author: Radu Mogoş <radu.mogos@pixelplant.ch>
 * Date: 03.04.2015 @ 18:59
 * Project: Conţinut CMS
 */
namespace Continut\Core\Mvc\View {

	use Continut\Core\Utility;

	class Container {
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

		protected $_id;

		/**
		 * @var array Template variables
		 */
		protected $_variables;

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

		public function getId()
		{
			return $this->_id;
		}

		/**
		 * @param mixed $id
		 *
		 * @return $this
		 */
		public function setId($id)
		{
			$this->_id = $id;

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
			if (!empty($this->_variables)) {
				extract($this->_variables);
			}
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
			$this->_elements[$element->getId()] = $element;

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

			return $htmlElements;
		}

		public function helper($helperName) {
			return Utility::helper($helperName);
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

		public function assignMultiple($values) {
			foreach ($values as $key => $value) {
				$this->_variables[$key] = $value;
			}
		}

	}

}
