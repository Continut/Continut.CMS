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
		 * @var \Extensions\System\Debug\DebugBar\StandardDebugBar
		 */
		protected $_debug;

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

			Utility::debugData("application", "start", "Application context");
			Utility::setApplicationScope($applicationScope, $environment);

			return $this;
		}

		/**
		 * @param bool $show Show or hide the PHP debugbar
		 *
		 * @return $this
		 */
		public function showDebugBar($show = FALSE) {
			Utility::debug();

			return $this;
		}

		/**
		 * Loads all the core configurations, like the class mapper, etc
		 *
		 * @return $this
		 */
		public function loadExtensionsConfiguration() {
			// Load Local and System extensions configuration data
			Utility::debugData("load_extensions_configuration", "start", "Loading extensions configuration");
			Utility::loadExtensionsConfigurationFromFolder(__ROOTCMS__ . DS . "Extensions" . DS . "Local");
			Utility::loadExtensionsConfigurationFromFolder(__ROOTCMS__ . DS . "Extensions" . DS . "System");
			Utility::debugData("load_extensions_configuration", "stop");

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
			Utility::debugData("controller_call", "start", "Main call and rendering");
			$request = Utility::getRequest();
			$request->mapRouting();

			// Get request argument values or switch to default values if not defined
			$contextExtension  = $request->getArgument("_extension",  "Frontend");
			$contextController = $request->getArgument("_controller", "Index");
			$contextAction     = $request->getArgument("_action",     "index");

			$content = Utility::callPlugin($contextExtension, $contextController, $contextAction);

			echo $content;

			return $this;
		}

		public function connectBackendController() {
			Utility::debugData("controller_call", "start", "Main call and rendering");
			$layout = Utility::createInstance("\\Core\\System\\View\\BackendLayout");
			$layout->setTemplate("/Extensions/System/Backend/Resources/Private/Backend/Layouts/Default.layout.php");

			$pageView = Utility::createInstance("\\Core\\Mvc\\View\\PageView");
			$pageView->setLayout($layout);

			$request = Utility::getRequest();

			// Get request argument values or switch to default values if not defined
			$contextExtension  = $request->getArgument("_extension",  "Backend");
			$contextController = $request->getArgument("_controller", "Index");
			$contextAction     = $request->getArgument("_action",     "dashboard");

			$controller = Utility::getController($contextExtension, $contextController, $contextAction);

			// If it's not an AJAX request, load layout and pageview then render it otherwise just return directly the response
			if (!Utility::getRequest()->isAjax()) {
				if ($controller->getLayoutTemplate()) {
					$pageView->getLayout()->setTemplate($controller->getLayoutTemplate());
				}
				$pageView->getLayout()->setContent($controller->getRenderOutput());

				echo $pageView->render();
			} else {
				echo $controller->getRenderOutput();
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

			Utility::$session = $userSession;

			return $this;

		}
	}
}