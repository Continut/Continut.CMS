<?php
/**
 * This file is part of the Conţinut CMS project.
 * Distributed under the GNU General Public License.
 * For more details, consult the LICENSE.txt file supplied with the project

 * Author: Radu Mogoş <radu.mogos@pixelplant.ch>
 * Date: 29.03.2015 @ 18:00
 * Project: Conţinut CMS
 */

namespace Core {
	use \Core\Utility;

	/**
	 * Main Class that bootstraps the system
	 * @package Core
	 */
	class Bootstrap {

		/**
		 * Current Bootstrap instance
		 *
		 * @var \Core\Boostrap
		 */
		static protected $_instance;

		/**
		 * @var string Current running environment, "DEVELOPMENT" or "PRODUCTION"
		 */
		protected $_environment = "DEVELOPMENT";

		protected $databaseHandler;

		/**
		 * Returns or creates a Bootstrap instance
		 *
		 * @return Boostrap
		 */
		public static function getInstance() {
			if (empty(static::$_instance)) {
				static::$_instance = new static();
			}
			return static::$_instance;
		}

		/**
		 * Set current running environment
		 *
		 * @param $environment
		 *
		 * @return $this
		 */
		public function setEnvironment($environment) {
			$this->_environment = $environment;
			return $this;
		}

		/**
		 * A simple basic class loader so far
		 * Class caching and mapping will be provided shortly
		 *
		 * @param string $class Namespace + classname to load
		 */
		public function loadClasses($class) {
			include $class.".php";
		}

		/**
		 * Loads all the core configurations, like the class mapper, etc
		 *
		 * @return $this
		 */
		public function loadConfiguration() {
			// @TODO - move the load_classes method to a proper class that does Class caching
			spl_autoload_register([$this, "loadClasses"], TRUE, FALSE);

			// Load Local and System extensions configuration data
			Utility::loadExtensionsConfigurationFromFolder(__ROOTCMS__ . DS . "Extensions" . DS . "Local");
			Utility::loadExtensionsConfigurationFromFolder(__ROOTCMS__ . DS . "Extensions" . DS . "System");

			return $this;
		}

		/**
		 * Start content output
		 *
		 * @return $this
		 */
		public function startOutput() {
			ob_start();
			return $this;
		}

		/**
		 * End content output
		 *
		 * @return $this
		 */
		public function endOutput() {
			ob_end_clean();
			return $this;
		}

		/**
		 * Call the current parsed controller and action using the extension"s context
		 *
		 * @return $this
		 *
		 * @throws \Core\Tools\Exception
		 */
		public function connectController() {
			$request = Utility::getRequest();

			/*$pageId = (int)$request->getArgument("pid", 0);
			$page = Utility::createInstance("\\Core\\Mvc\\View\\PageView");
			$layout = Utility::createInstance("\\Core\\Mvc\\View\\BaseLayout");
			$layout->setTemplate(__ROOTCMS__ . "/Extensions/Local/News/Resources/Private/Frontend/Layouts/Default.layout.php");
			$page->setLayout($layout);
			$pageView = $page->render();
			echo $pageView;
			die();*/

			// Get request argument values or switch to default values if not defined
			$contextExtension  = $request->getArgument("_extension",  "Frontend");
			$contextController = $request->getArgument("_controller", "Index") . "Controller";
			$contextAction     = $request->getArgument("_action",     "index") . "Action";

			// Get the type of the extension from it's settings data
			$extensionType = Utility::getExtensionSettings($contextExtension)["type"];

			// Prepare the controller to load
			$classToLoad = "Extensions\\$extensionType\\$contextExtension\\Classes\\Controllers\\$contextController";

			// Instantiate the controller
			$controller = Utility::createInstance($classToLoad);

			// and call it's action method, if it exists
			if (!method_exists($controller, $contextAction)) {
				throw new \Core\Tools\Exception("The action you are trying to call does not exist for this controller", 30000002);
			}

			// pass the request object to the controller so that we have access to it inside our action
			$controller->setRequest($request);

			// then execute it's action
			$viewContent = $controller->$contextAction();

			// if no data was returned, then fetch the template linked to this action
			if (empty($viewContent)) {
				$viewContent = $controller->getView()->render();
			}

			echo $viewContent;

			return $this;
		}

		/**
		 * Create a database handler and connect to the database
		 *
		 * @return $this
		 */
		public function connectToDatabase() {
			Utility::connectToDatabase();

			return $this;
		}

		/**
		 * Disconnect from database
		 *
		 * @return $this
		 */
		public function disconnectFromDatabase() {
			Utility::disconnectFromDatabase();

			return $this;
		}

		/**
		 * @return mixed
		 */
		public function getDatabaseHandler() {
			return $this->databaseHandler;
		}
	}
}