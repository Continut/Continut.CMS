<?php
/**
 * This file is part of the Conţinut CMS project.
 * Distributed under the GNU General Public License.
 * For more details, consult the LICENSE.txt file supplied with the project
 
 * Author: Radu Mogoş <radu.mogos@pixelplant.ch>
 * Date: 06.04.2015 @ 19:28
 * Project: Conţinut CMS
 */
namespace Core\System\View {

	use Core\Mvc\View\BaseLayout;

	class FrontendLayout extends BaseLayout {

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
		 * Show all content from a container
		 *
		 * @param $id Id if the container to show
		 */
		public function showContainerColumn($id) {
			if (empty($this->_elements))
				return;

			$htmlElements = "";

			foreach ($this->getElements() as $element) {
				if ($element->getColumn() == $id) {
					$htmlElements .= $element->render($element->children);
				}
			}
			echo $htmlElements;
		}
	}

}
