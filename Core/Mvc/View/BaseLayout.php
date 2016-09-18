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

	use Continut\Core\Utility;

	class BaseLayout extends BaseView {

		/**
		 * @var PageView the Pageview this layout is linked to
		 */
		protected $pageView = NULL;

		/**
		 * Tree of elements to render by this layout
		 *
		 * @var mixed
		 */
		protected $elements;

		/**
		 * @return mixed
		 */
		public function getElements() {
			return $this->elements;
		}

		/**
		 * @param $elements
		 */
		public function setElements($elements) {
			$this->elements = $elements;
		}

		/**
		 * Set the PageView this layout belongs to
		 *
		 * @param PageView $pageView
		 *
		 * @return $this
		 */
		public function setPageView($pageView) {
			$this->pageView = $pageView;

			return $this;
		}

		/**
		 * @return PageView
		 */
		public function getPageView() {
			return $this->pageView;
		}

		/**
		 * Render layout
		 *
		 * @return string
		 */
		public function render() {
			if (!is_file($this->template)) {
				Utility::debugData($this->__("backend.layout.noLayoutSpecified"), "error");
				return $this->__("backend.layout.noLayoutSpecified");
			} else {
				ob_start();
				include_once $this->template;
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
			if (empty($this->elements))
				return;

			$htmlElements = "";

			Utility::debugData("Container ($id) rendering", "start");
			Utility::debugData("Container id: " . $id, "message");
			foreach ($this->getElements() as $element) {
				if ($element->getColumnId() == $id) {
					$htmlElements .= $element->render($element->children);
				}
			}
			Utility::debugData("Container ($id) rendering", "stop");
			return $htmlElements;
		}
	}

}
