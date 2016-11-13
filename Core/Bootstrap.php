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

    use Continut\Core\Tools\Exception;
    use Continut\Core\Tools\HttpException;

    /**
     * Main Class that bootstraps the system
     *
     * @package Continut\Core
     */
    class Bootstrap
    {

        /**
         * Current Bootstrap instance
         *
         * @var \Continut\Core\Boostrap
         */
        static protected $instance;

        /**
         * @var string Final content that gets rendered after all controllers/plugins/layouts/views are executed
         */
        static protected $renderContent = '';

        /**
         * Returns or creates a Bootstrap instance
         *
         * @return \Continut\Core\Boostrap
         */
        public static function getInstance()
        {
            if (empty(static::$instance)) {
                static::$instance = new static();
            }
            return static::$instance;
        }

        /**
         * Set current running environment
         *
         * @param string $applicationScope
         * @param string $environment
         *
         * @return $this
         */
        public function setEnvironment($applicationScope, $environment)
        {
            require_once "Tools/Autoloader.php";
            require_once "Utility.php";

            Utility::$autoloader = new Tools\Autoloader();
            Utility::$autoloader->register();
            // Main namespace for app
            Utility::$autoloader->addNamespace("Continut", __ROOTCMS__);
            // Debugbar: http://phpdebugbar.com
            Utility::$autoloader->addNamespace("DebugBar", __ROOTCMS__ . DS . "Lib" . DS . "DebugBar");
            Utility::$autoloader->addNamespace("Symfony", __ROOTCMS__ . DS . "Lib" . DS . "Symfony");
            Utility::$autoloader->addNamespace("Psr", __ROOTCMS__ . DS . "Lib" . DS . "Psr");
            // Image resize capabilities: http://image.intervention.io
            Utility::$autoloader->addNamespace("Intervention", __ROOTCMS__ . DS . "Lib" . DS . "Intervention");

            set_exception_handler([$this, "handleException"]);
            set_error_handler([$this, 'handleError']);

            Utility::setApplicationScope($applicationScope, $environment);
            Utility::debugData("Application", "start");

            return $this;
        }

        /**
         * @param \Exception $exception
         */
        public function handleException($exception)
        {
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
                // in PHP 7 you can receive both an error or an exception
                if ($exception instanceof \Error) {
                    Utility::debugData($exception, "error");
                } else {
                    Utility::debugData($exception, "exception");
                }

                var_dump($exception);
            }
        }

        /**
         * @param int    $code
         * @param string $message
         * @param string $file
         * @param int    $line
         *
         * @throws Exception
         */
        public function handleError($code, $message, $file, $line)
        {
            echo $code . $message . $file . ' on line ' . $line;
            //throw new ErrorException($message, $code);
        }

        /**
         * Loads all the core configurations, like the class mapper, etc
         *
         * @return $this
         */
        public function loadExtensionsConfiguration()
        {
            // Load Local and System extensions configuration data
            Utility::debugData("Loading extensions configuration", "start");
            Utility::loadExtensionsConfigurationFromFolder(__ROOTCMS__ . DS . "Extensions", "Local");
            Utility::loadExtensionsConfigurationFromFolder(__ROOTCMS__ . DS . "Extensions", "System");
            Utility::debugData("Loading extensions configuration", "stop");

            return $this;
        }

        /**
         * @return $this
         */
        public function initializeWebsite()
        {
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
         * Call the current parsed controller and action using the extension's context
         *
         * @return $this
         *
         * @throws \Continut\Core\Tools\Exception
         */
        public function connectFrontendController()
        {
            Utility::debugData("Main frontend controller called", "start");

            $request = Utility::getRequest();
            $request->mapRouting();

            // Get request argument values or switch to default values if not defined
            $contextExtension  = $request->getArgument("_extension", "Frontend");
            $contextController = $request->getArgument("_controller", "Index");
            $contextAction     = $request->getArgument("_action", "index");

            self::$renderContent = Utility::callPlugin($contextExtension, $contextController, $contextAction);

            return $this;
        }

        public function connectBackendController()
        {
            Utility::debugData("Main backend controller called", "start");

            try {
                $request = Utility::getRequest();
                $request->mapRouting();

                // Get request argument values or switch to default values if not defined
                $contextExtension  = $request->getArgument("_extension", "Backend");
                $contextController = $request->getArgument("_controller", "Index");
                $contextAction     = $request->getArgument("_action", "dashboard");

                $controller = Utility::getController($contextExtension, $contextController, $contextAction);

                if (!$controller->getUseLayout() || Utility::getRequest()->isAjax()) {
                    self::$renderContent = $controller->getRenderOutput();
                    // for ajax requests use the Ajax debugger, if it is enabled
                    if (Utility::getRequest()->isAjax()) {
                        Utility::debugAjax();
                    }
                } else {
                    // If it's not an AJAX request, load layout and pageview then render it otherwise just return directly the response
                    /* @var \Continut\Core\System\View\BackendLayout $layout */
                    $layout = Utility::createInstance('\Continut\Core\System\View\BackendLayout');
                    $layout->setTemplate("/Extensions/System/Backend/Resources/Private/Backend/Layouts/Default.layout.php");

                    /* @var \Continut\Core\Mvc\View\PageView $pageView */
                    $pageView = Utility::createInstance('\Continut\Core\Mvc\View\PageView');
                    $pageView
                        ->setWrapperTemplate('Extensions/System/Backend/Resources/Private/Backend/Wrappers/Html5')
                        ->setLayout($layout);

                    $controller->setPageView($pageView);

                    // if the layout template is overwritten at the controller level, update it
                    if ($controller->getLayoutTemplate()) {
                        $pageView->getLayout()->setTemplate($controller->getLayoutTemplate());
                    }
                    $pageView->getLayout()->setContent($controller->getRenderOutput());

                    self::$renderContent = $pageView->render();
                }
            } catch (Exception $e) {
                self::$renderContent = $e->getMessage();
            }

            return $this;
        }

        /**
         * Create a database handler and connect to the database
         *
         * @return $this
         */
        public function connectToDatabase()
        {
            Utility::connectToDatabase();

            return $this;
        }

        /**
         * Disconnect from database
         *
         * @return $this
         */
        public function disconnectFromDatabase()
        {
            Utility::disconnectFromDatabase();

            return $this;
        }

        /**
         * Start User session
         *
         * @return $this
         * @throws Tools\Exception
         */
        public function startSession()
        {
            // Create our session handler
            $userSession = Utility::createInstance('Continut\Core\System\Domain\Model\UserSession');
            session_name("ContinutCMS");
            session_set_save_handler($userSession, true);
            session_save_path(__ROOTCMS__ . DS . 'Tmp' . DS . 'Session');
            session_start();

            if ($userSession->get('user_id')) {
                $userId = (int)$userSession->get('user_id');
                $user = Utility::createInstance('Continut\Core\System\Domain\Collection\BackendUserCollection')->findById($userId);
                if (!$user) {
                    $user = Utility::createInstance('Continut\Core\System\Domain\Model\BackendUser');
                }
                $userSession->setUser($user);
            }

            Utility::$session = $userSession;

            return $this;

        }

        /**
         * Dumps the rendered content to screen
         */
        public function render() {
            echo self::$renderContent;
        }
    }
}
