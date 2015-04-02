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
		 * Loads all the core configurations, like the class mapper, etc
		 *
		 * @return $this
		 */
		public function loadConfiguration() {
			// @TODO - move the load_classes method to a proper class that does Class caching
			spl_autoload_register("load_classes", TRUE, FALSE);

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
			if ($request->hasArgument("extension")) {
				$contextExtension  = $request->getArgument("extension");
			} else {
				$contextExtension = "Backend";
			}
			$contextController = $request->getArgument("controller") . "Controller";
			if ($request->hasArgument("action")) {
				$contextAction = $request->getArgument("action") . "Action";
			} else {
				$contextAction = "indexAction";
			}
			$extensionType     = Utility::getExtensionSettings($contextExtension)["type"];
			$classToLoad = "Extensions\\$extensionType\\$contextExtension\\Classes\\Controllers\\$contextController";
			$controller = Utility::createInstance($classToLoad);
			if (!method_exists($controller, $contextAction)) {
				throw new \Core\Tools\Exception("The action you are trying to call does not exist for this controller", 30000002);
			}
			$controller->setRequest($request);
			$controller->$contextAction();

			return $this;
		}

		/**
		 * Create a database handler and connect to the database
		 *
		 * @param string $type Database connection type: "mysql", "sqlite", etc...
		 * @throws \Core\Tools\Exception
		 *
		 * @return $this
		 */
		public function connectToDatabase($type = "mysql") {
			try {
				$this->databaseHandler = new \PDO("mysql:host=localhost;dbname=continutcms", "root", "");
				$this->databaseHandler->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
			}
			catch (\PDOException $e) {
				throw new \Core\Tools\Exception("Cannot connect to the database. Please check username, password and host", 20000001);
			}
			return $this;
		}

		/**
		 * Disconnect from database
		 *
		 * @return $this
		 */
		public function disconnectDatabase() {
			$this->databaseHandler = NULL;
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