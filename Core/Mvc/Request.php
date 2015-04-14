<?php
/**
 * This file is part of the Conţinut CMS project.
 * Distributed under the GNU General Public License.
 * For more details, consult the LICENSE.txt file supplied with the project

 * Author: Radu Mogoş <radu.mogos@pixelplant.ch>
 * Date: 30.03.2015 @ 20:40
 * Project: Conţinut CMS
 */

namespace Core\Mvc {

	/**
	 * Request Class Handler
	 * @package Core\Mvc
	 */
	class Request {
		/**
		 * @var array Request arguments ($_GET, $_SET, $_SESSION, etc)
		 */
		protected $arguments = [];

		/**
		 * @var string Controller name
		 */
		protected $controller = "IndexController";

		/**
		 * @var string Controller action name
		 */
		protected $action = "indexAction";

		/**
		 * Request format: html, json, etc
		 *
		 * @var string
		 */
		protected $format = "html";

		/**
		 * Request contructor
		 */
		public function __construct() {
			$this->setArguments(array_merge($_GET, $_POST));
		}

		/**
		 * Gets the controller name
		 *
		 * @return string
		 */
		public function getController()
		{
			return $this->controller;
		}

		/**
		 * Sets the controller name
		 *
		 * @param string $controller
		 *
		 * @throws \Core\Tools\Exception
		 * @return void
		 */
		public function setController($controller)
		{
			if (empty($controller)) {
				throw new \Core\Tools\Exception("No controller has been found. Are you sure a controller was passed as an argument?", 40000001);
			}
			$this->controller = $controller;
		}

		/**
		 * Gets the controller action to be called
		 *
		 * @return string
		 */
		public function getAction()
		{
			return $this->action;
		}

		/**
		 * Sets the controller action to be called
		 *
		 * @param string $action
		 *
		 * @throws \Core\Tools\Exception
		 * @return void
		 */
		public function setAction($action)
		{
			if (empty($action)) {
				throw new \Core\Tools\Exception("No action has been found. Are you sure a controller action was passed as an argument?", 40000002);
			}
			$this->action = $action;
		}

		/**
		 * Returns the request arguments
		 *
		 * @return array
		 */
		public function getArguments()
		{
			return $this->arguments;
		}

		/**
		 * Sets the request arguments
		 *
		 * @param array $arguments
		 */
		public function setArguments($arguments)
		{
			$this->arguments = $arguments;
		}

		/**
		 * Get argument value by name
		 *
		 * @param string $argumentName
		 * @param mixed $defaultValue default value returned if argument is not set
		 *
		 * @return mixed
		 * @throws \Core\Tools\Exception
		 */
		public function getArgument($argumentName, $defaultValue = NULL) {
			if (!isset($this->arguments[$argumentName])) {
				if (!is_null($defaultValue)) {
					return $defaultValue;
				}
				return FALSE;
				//throw new \Core\Tools\Exception("The supplied argument name does not exist", 40000003);
			}
			return $this->arguments[$argumentName];
		}

		/**
		 * Set an argument's value and check for special arguments like the controller or action
		 *
		 * @param $argument
		 * @param $value
		 *
		 * @throws \Core\Tools\Exception
		 */
		public function setArgument($argument, $value) {
			switch ($argument) {
				case 'controller':
					$this->setController($value); break;
				case 'action':
					$this->setAction($value); break;
				case 'format':
					$this->setFormat($format); break;
				default:
					$this->arguments[$argument] = $value;
			}
		}

		/**
		 * Check if an argument is set
		 *
		 * @param $argumentName
		 *
		 * @return bool
		 */
		public function hasArgument($argumentName) {
			return isset($this->arguments[$argumentName]);
		}

		/**
		 * Return request format
		 *
		 * @return string
		 */
		public function getFormat()
		{
			return $this->format;
		}

		/**
		 * Set request format
		 *
		 * @param string $format
		 *
		 * @return void
		 */
		public function setFormat($format)
		{
			$this->format = $format;
		}

		/**
		 * Check if it's an AJAX Request. Should work at least with jQuery
		 *
		 * @return bool
		 */
		public function isAjax() {
			return (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest');
		}

	}
}