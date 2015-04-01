<?php
/**
 * This file is part of the Conţinut CMS project.
 * Distributed under the GNU General Public License.
 * For more details, consult the LICENSE.txt file supplied with the project

 * Author: Radu Mogoş <radu.mogos@pixelplant.ch>
 * Date: 29.03.2015 @ 18:43
 * Project: Conţinut CMS
 */

namespace Core\Mvc\View {

	/**
	 * Class BaseView
	 *
	 * @package Core\Mvc\View
	 */
	class BaseView {

		/**
		 * @var string The template file to use for the view
		 */
		protected $_template;

		/**
		 * @var array List of values sent to the view
		 */
		protected $_variables;

		public function __constructor($template) {
			$this->_template = $template;
		}

		/**
		 * Assign a variable and value to the View variables list
		 *
		 * @param $key string Name of variable to set
		 * @param $value mixed Value of the variable
		 *
		 * @return $this
		 */
		public function assign($key, $value) {
			$this->_variables[$key] = $value;
			return $this;
		}

		/**
		 * Assign multiple values to the View variables
		 *
		 * @param array $values
		 *
		 * @return $this
		 */
		public function assignMultiple(array $values) {
			foreach ($values as $key => $value) {
				$this->_variables[$key] = $value;
			}
			return $this;
		}

		/**
		 * Return the value of a View variable
		 *
		 * @param $key
		 *
		 * @return null
		 */
		public function getVariable($key) {
			if (isset($this->_variables[$key])) {
				return $this->_variables[ $key ];
			} else {
				return NULL;
			}
		}

		/**
		 * @return $this
		 */
		public function render() {
			return $this;
		}

		public function initializeView() {
			require_once $this->_template;
		}
	}
}