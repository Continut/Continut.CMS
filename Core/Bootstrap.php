<?php
/**
 * This file is part of the Conţinut CMS project.
 * Distributed under the GNU General Public License.
 * For more details, consult the LICENSE.txt file supplied with the project

 * Author: Radu Mogoş <radu.mogos@pixelplant.ch>
 * Date: 29.03.2015 @ 18:00
 * Project: Conţinut CMS
 */

namespace Continut\Core {

	use Continut\Core\Tools\ErrorException;
	use Continut\Core\Tools\Exception;
	use Continut\Core\Tools\HttpException;

	/**
	 * Main Class that bootstraps the system
	 *
	 * @package Continut\Core
	 */
	class Bootstrap {

		/**
		 * Current Bootstrap instance
		 *
		 * @var \Continut\Core\Boostrap
		 */
		static protected $_instance;

		/**
		 * Returns or creates a Bootstrap instance
		 *
		 * @return \Continut\Core\Boostrap
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
		 * @param string $applicationScope
		 * @param string $environment
		 *
		 * @return $this
		 */
		public function setEnvironment($applicationScope, $environment) {
			require_once "Autoloader.php";
			require_once "Utility.php";

			Utility::$autoloader = new \Continut\Core\Autoloader();
			Utility::$autoloader->register();
			Utility::$autoloader->addNamespace("Continut", __ROOTCMS__);
			Utility::$autoloader->addNamespace("Doctrine", __ROOTCMS__ . DS . "Lib" . DS . "Doctrine");
			Utility::$autoloader->addNamespace("DebugBar", __ROOTCMS__ . DS . "Lib" . DS . "DebugBar");
			Utility::$autoloader->addNamespace("Symfony",  __ROOTCMS__ . DS . "Lib" . DS . "Symfony");
			Utility::$autoloader->addNamespace("Psr",      __ROOTCMS__ . DS . "Lib" . DS . "Psr");

			set_exception_handler([$this, "handleException"]);
			set_error_handler([$this, 'handleError']);

			Utility::debugData("application", "start", "Application context");
			Utility::setApplicationScope($applicationScope, $environment);

			return $this;
		}

		/**
		 * @param \Exception $exception
		 */
		public function handleException($exception) {
			// General error template, for production mode
			$errorTemplate = "Public/Error.html";

			// Http exceptions have custom html templates, based on the error code
			// They are all stored inside the Public folder
			if ($exception instanceof HttpException) {
				switch ($exception->getCode()) {
					default:
						$code = (int)$exception->getCode();
						$errorTemplate = "Public/$code.html";
						break;
				}
			}

			// In production mode, we log any errors/exceptions and we do not show them in the frontend
			// For all the other environments, "Test", "Development" or your custom ones, we show the errors
			if (Utility::getApplicationEnvironment() == "Production") {
				// TODO Create log class and log data
				$view = Utility::createInstance('Continut\Core\Mvc\View\BaseView');
				$view->setTemplate($errorTemplate);
				echo $view->render();
			} else {
				Utility::debugData($exception, "exception");
				echo $exception->getMessage();
			}
		}

		/**
		 * @param int    $code
		 * @param string $message
		 * @param string $file
		 * @param string $line
		 *
		 * @throws Exception
		 */
		public function handleError($code, $message, $file, $line) {
			echo $code.$message.$file;
			//throw new ErrorException($message, $code);
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
		 * @return $this
		 */
		public function initializeWebsite() {
			// on the frontend we use the locale setup in the domain url, if any
			if (Utility::getApplicationScope() == Utility::SCOPE_FRONTEND) {
				Utility::setCurrentWebsite();

				if (Utility::getSite()->getDomainUrl()->getLocale()) {
					Utility::setConfiguration("System/Locale", Utility::getSite()->getDomainUrl()->getLocale());
				}
			}
			setlocale(LC_ALL, Utility::getConfiguration("System/Locale"));

			return $this;
		}

		/**
		 * Call the current parsed controller and action using the extension"s context
		 *
		 * @return $this
		 *
		 * @throws \Continut\Core\Tools\Exception
		 */
		public function connectFrontendController() {
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

			$content = "";

			try {

				$layout = Utility::createInstance("\\Continut\\Core\\System\\View\\BackendLayout");
				$layout->setTemplate("/Extensions/System/Backend/Resources/Private/Backend/Layouts/Default.layout.php");

				$pageView = Utility::createInstance("\\Continut\\Core\\Mvc\\View\\PageView");
				$pageView->setLayout($layout);

				$request = Utility::getRequest();

				// Get request argument values or switch to default values if not defined
				$contextExtension = $request->getArgument("_extension", "Backend");
				$contextController = $request->getArgument("_controller", "Index");
				$contextAction = $request->getArgument("_action", "dashboard");

				$controller = Utility::getController($contextExtension, $contextController, $contextAction);

				// If it's not an AJAX request, load layout and pageview then render it otherwise just return directly the response
				if (!Utility::getRequest()->isAjax()) {
					if ($controller->getLayoutTemplate()) {
						$pageView->getLayout()->setTemplate($controller->getLayoutTemplate());
					}
					$pageView->getLayout()->setContent($controller->getRenderOutput());

					$content = $pageView->render();
				} else {
					$content = $controller->getRenderOutput();
					Utility::debugAjax();
				}
			}
			catch (Exception $e) {
				$content = $e->getMessage();
			}

			echo $content;

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
			$userSession = Utility::createInstance("\\Continut\\Core\\System\\Session\\UserSession");
			session_name("ContinutCMS");
			session_set_save_handler($userSession, true);
			session_start();

			Utility::$session = $userSession;

			return $this;

		}
	}
}