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
	use Core\Utility;

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
		 * Set View template file
		 *
		 * @param string $template Template file to use
		 */
		public function setTemplate($template) {
			$this->_template = $template;
		}

		/**
		 * Get View template file
		 *
		 * @return string
		 */
		public function getTemplate() {
			return $this->_template;
		}

		/**
		 * @return $this
		 *
		 * @throws \Core\Tools\Exception
		 */
		public function render() {
			$fullpath = __ROOTCMS__ . $this->_template;
			if (!is_file($fullpath)) {
				throw new \Core\Tools\Exception("The specified template file does not exist " . $this->_template, 10000001);
			}
			if (!empty($this->_variables)) {
				extract($this->_variables);
			}
			ob_start();
			include($fullpath);
			return ob_get_clean();
		}

		public function useLayout($layoutName) {

		}

		/**
		 * Render a partial template file
		 *
		 * @param string $extensionName Name of the extension where the partial is located
		 * @param string $partialFilename Relative Path and complete filename of the partial
		 * @param array  $variables List of variables to pass on to the partial
		 */
		public function partial($extensionName, $partialFilename, $variables = []) {
			$partialView = Utility::createInstance("Core\\Mvc\\View\\BaseView");
			$partialView->assignMultiple($variables);
			$partialView->setTemplate(Utility::getTemplateFileFromPath($extensionName, "Partials", $partialFilename));
			return $partialView->render();
		}

		/**
		 * Call a helper to access it's methods
		 *
		 * @param string $helperName
		 *
		 * @return mixed
		 */
		public function helper($helperName) {
			return Utility::helper($helperName);
		}

		public function plugin($extensionName, $controller, $action) {
			return Utility::callPlugin($extensionName, $controller, $action);
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

		public function publicAsset($assetName, $extension) {
			return Utility::getAssetPath($assetName, $extension);
		}
	}
}