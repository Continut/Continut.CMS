<?php
/**
 * This file is part of the Conţinut CMS project.
 * Distributed under the GNU General Public License.
 * For more details, consult the LICENSE.txt file supplied with the project
 
 * Author: Radu Mogoş <radu.mogos@pixelplant.ch>
 * Date: 03.04.2015 @ 18:55
 * Project: Conţinut CMS
 */
namespace Continut\Core\Mvc\View {

	use Continut\Core\Tools\Exception;
	use Continut\Core\Utility;

	class BaseLayout extends BaseView {

		/**
		 * @var PageView the Pageview this layout is linked to
		 */
		protected $_page = NULL;

		/**
		 * Tree of elements to render by this layout
		 *
		 * @var mixed
		 */
		protected $_elements;

		/**
		 * @return mixed
		 */
		public function getElements() {
			return $this->_elements;
		}

		/**
		 * @param $elements
		 */
		public function setElements($elements) {
			$this->_elements = $elements;
		}

		/**
		 * Set the PageView this layout belongs to
		 *
		 * @param PageView $page
		 *
		 * @return $this
		 */
		public function setPage($page) {
			$this->_page = $page;

			return $this;
		}

		/**
		 * @return PageView
		 */
		public function getPage() {
			return $this->_page;
		}

		/**
		 * Render layout
		 *
		 * @return string
		 */
		public function render() {
			if (!is_file($this->_template)) {
				Utility::debugData($this->__("backend.layout.noLayoutSpecified"), "error");
				return $this->__("backend.layout.noLayoutSpecified");
			} else {
				ob_start();
				include_once $this->_template;
				return ob_get_clean();
			}
		}

		/**
		 * Show all content from a container
		 *
		 * @param int $id Id if the container to show
		 *
		 * @return string
		 */
		public function showContainerColumn($id) {
			if (empty($this->_elements))
				return;

			$htmlElements = "";

			Utility::debugData("container_rendering", "start", "Container (" . $id . ") rendering completed");
			Utility::debugData("Container with id follows: " . $id, "message");
			foreach ($this->getElements() as $element) {
				if ($element->getColumnId() == $id) {
					$htmlElements .= $element->render($element->children);
				}
			}
			Utility::debugData("container_rendering", "stop");
			return $htmlElements;
		}
	}

}
