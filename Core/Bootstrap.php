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
		 * A simple basic class loader so far
		 * Class caching and mapping will be provided shortly
		 *
		 * @param string $class Namespace + classname to load
		 */
		public function loadClasses($class) {
			$class = __ROOTCMS__ . DS . str_replace("\\", DS, $class) . ".php";
			include_once $class;
		}

		/**
		 * Set current running environment
		 *
		 * @param string $applicationScope
		 * @param string $environment
		 *
		 * @return $this
		 */
		public function setEnvironment($applicationScope, $environment) {
			// @TODO - move the load_classes method to a proper class that does Class caching
			spl_autoload_register([$this, "loadClasses"], TRUE, FALSE);

			Utility::setApplicationScope($applicationScope, $environment);
			return $this;
		}

		/**
		 * Loads all the core configurations, like the class mapper, etc
		 *
		 * @return $this
		 */
		public function loadConfiguration() {
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

			// Get request argument values or switch to default values if not defined
			$contextExtension  = $request->getArgument("_extension",  "Frontend");
			$contextController = $request->getArgument("_controller", "Index");
			$contextAction     = $request->getArgument("_action",     "index");

			echo Utility::callPlugin($contextExtension, $contextController, $contextAction);

			return $this;
		}

		public function connectBackendController() {
			$layout = Utility::createInstance("\\Core\\System\\View\\BackendLayout");
			$layout->setTemplate("/Extensions/System/Backend/Resources/Private/Backend/Layouts/Default.layout.php");

			$pageView = Utility::createInstance("\\Core\\Mvc\\View\\PageView");
			$pageView->setLayout($layout);

			$request = Utility::getRequest();

			// Get request argument values or switch to default values if not defined
			$contextExtension  = $request->getArgument("_extension",  "Backend");
			$contextController = $request->getArgument("_controller", "Index");
			$contextAction     = $request->getArgument("_action",     "dashboard");

			$content = Utility::callPlugin($contextExtension, $contextController, $contextAction);

			// If it's an AJAX request, ignore layout rendering
			if (!Utility::getRequest()->isAjax()) {
				$pageView->getLayout()->setContent($content);

				echo $pageView->render();
			} else {
				echo $content;
			}

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
		 * Start User session
		 *
		 * @return $this
		 * @throws Tools\Exception
		 */
		public function startSession() {
			// Create our session handler
			$userSession = Utility::createInstance("\\Core\\System\\Session\\UserSession");
			session_name("ContinutCMS");
			session_set_save_handler($userSession, true);
			session_start();

			// Create our Frontend or Backend user object
			$user = Utility::createInstance("\\Core\\System\\Session\\User");

			return $this;

		}
	}
}