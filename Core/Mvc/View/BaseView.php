<?php
/**
 * This file is part of the Conţinut CMS project.
 * Distributed under the GNU General Public License.
 * For more details, consult the LICENSE.txt file supplied with the project

 * Author: Radu Mogoş <radu.mogos@pixelplant.ch>
 * Date: 29.03.2015 @ 18:43
 * Project: Conţinut CMS
 */

namespace Continut\Core\Mvc\View {

	use Continut\Core\Tools\ErrorException;
	use Continut\Core\Utility;

	/**
	 * Class BaseView
	 *
	 * @package Continut\Core\Mvc\View
	 */
	class BaseView {

		/**
		 * @var string The template file to use for the view
		 */
		protected $_template;

		/**
		 * @var string Relative template path
		 */
		protected $_relativePath;

		/**
		 * @var array List of values sent to the view
		 */
		protected $_variables;

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
		 *
		 * @return $this
		 */
		public function setTemplate($template) {
			$this->_template = $template;
			$this->_relativePath = str_replace(__ROOTCMS__, "", $this->_template);

			return $this;
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
		 * @return string
		 */
		public function getRelativePath() {
			return $this->_relativePath;
		}

		/**
		 * @return string
		 *
		 * @throws \Core\Tools\Exception
		 */
		public function render() {
			$fullpath = $this->_template;
			if (!is_file($fullpath)) {
				Utility::debugData("View missing: " . $this->getRelativePath(), "error");
				throw new ErrorException("The specified template file does not exist " . $this->_template, 10000001);
				return $this->__("backend.content.templateMissing");
			} else {
				Utility::debugData("View loaded: " . $this->getRelativePath(), "message");
				Utility::debugData("view_render" . md5($this->_template), "start", "View render ". str_replace(__ROOTCMS__, "", $this->_template));
				if (!empty($this->_variables)) {
					extract($this->_variables);
				}
				ob_start();
				include($fullpath);
				$content = ob_get_clean();
				Utility::debugData("view_render" . md5($this->_template), "stop");

				return $content;
			}
		}

		public function useLayout($layoutName) {

		}

		/**
		 * Render a partial template file
		 *
		 * @param string $partialFilename Relative Path and complete filename of the partial
		 * @param string $extensionName   Name of the extension where the partial is located
		 * @param string $scope           Scope of the resource, Frontend or Backend
		 * @param array  $variables       List of variables to pass on to the partial
		 */
		public function partial($partialFilename, $extensionName, $scope, $variables = []) {
			$partialView = Utility::createInstance('Continut\Core\Mvc\View\BaseView');
			$partialView->assignMultiple($variables);
			$partialView->setTemplate(Utility::getResource($partialFilename, $extensionName, $scope, "Partial"));
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
		 * @param string $labelKey   Label key to translate
		 * @param array  $parameters List of parameters to replace in the final string
		 *
		 * @return string
		 */
		public function __($labelKey, $parameters = []) {
			return Utility::helper("Localization")->translate($labelKey, $parameters);
		}

		public function publicAsset($assetName, $extension) {
			return Utility::getAssetPath($assetName, $extension);
		}
	}
}