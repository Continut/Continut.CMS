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
		protected $_elements;

		public function __construct() {

		}

		public function render() {

		}

		public function getElements() {
			return $this->_elements;
		}

		public function addElement($element) {
			$this->_elements[$element->getUid()] = $element;
		}

	}

}
