<?php
/**
 * This file is part of the Conţinut CMS project.
 * Distributed under the GNU General Public License.
 * For more details, consult the LICENSE.txt file supplied with the project
 * Author: Radu Mogoş <radu.mogos@pixelplant.ch>
 * Date: 29.03.2015 @ 18:00
 * Project: Conţinut CMS
 */

namespace Continut\Core;

use Continut\Core\Tools\ErrorException;
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
     * @var Bootstrap
     */
    static protected $instance;

    /**
     * @var string Final content that gets rendered after all controllers/plugins/layouts/views are executed
     */
    static protected $renderContent = '';

    /**
     * Returns or creates a Bootstrap instance
     *
     * @return Bootstrap
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
        require_once 'Utility.php';

        set_exception_handler([$this, 'handleException']);
        set_error_handler([$this, 'handleError']);

        // Load the composer autoloader
        Utility::$autoloader = require __ROOTCMS__ . '/Lib/autoload.php';

        Utility::setApplicationScope($applicationScope, $environment);
        Utility::debugData('Application', 'start');

        return $this;
    }

    /**
     * @param \Exception $exception
     */
    public function handleException($exception)
    {
        // General error template, for production mode
        $errorTemplate = 'Public/Error.html';

        // Http exceptions have custom html templates, based on the error code
        // They are all stored inside the Public folder
        // Not all HTTP error codes have html files created, so please add the ones you need as you see fit
        if ($exception instanceof HttpException) {
            switch ($exception->getCode()) {
                default:
                    $code = (int)$exception->getCode();
                    $errorTemplate = 'Public/' . $code .'.html';
                    break;
            }
        }

        // In production mode, we log any errors/exceptions and we do not show them in the frontend
        // For all the other environments, "Test", "Development" or your custom ones, we show the errors
        if (Utility::getApplicationEnvironment() == 'Production') {
            // @TODO Create log class and log data
            echo file_get_contents(__ROOTCMS__ . DS . $errorTemplate);
        } else {
            // in PHP 7 you can receive both an error or an exception in the exception handler function
            if ($exception instanceof \Error) {
                Utility::debugData($exception->getMessage() . ' ' . $exception->getTraceAsString(), 'error');
            } else {
                Utility::debugData($exception, 'exception');
            }
            Utility::debugAjax();
            // @TODO Log errors/exceptions
            var_dump($exception);
        }
    }

    /**
     * @param int $code
     * @param string $message
     * @param string $file
     * @param int $line
     *
     * @throws Exception
     */
    public function handleError($code, $message, $file, $line)
    {
        if (Utility::getApplicationEnvironment() == 'Production') {
            echo file_get_contents(__ROOTCMS__ . DS . 'Public' . DS . 'Error.html');
        } else {
            Utility::debugData($message . ' in file ' . $file . ' on line ' . $line, 'error');
            Utility::debugAjax();
        }
    }

    /**
     * Loads all the core configurations, like the class mapper, etc
     *
     * @return $this
     */
    public function loadExtensionsConfiguration()
    {
        // Load Local and System extensions configuration data
        Utility::debugData('Loading extensions configuration', 'start');
        Utility::loadExtensionsConfigurationFromFolder(__ROOTCMS__ . DS . 'Extensions', 'Local');
        Utility::loadExtensionsConfigurationFromFolder(__ROOTCMS__ . DS . 'Extensions', 'System');
        Utility::debugData('Loading extensions configuration', 'stop');

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
                Utility::setConfiguration('System/Locale', Utility::getSite()->getDomainUrl()->getLocale());
            }

            // merge configuration stored in the files with the configuration stored in the database
            // get "Global [domain_id = 0, language_id = 0]" config, then "Domain" config [domain_id = currentDomain, language_id = 0]
            // and finally get "Language" config [domain_id = currentDomain, language_id = currentLanguage]
            $configurationCollection = Utility::createInstance('Continut\Core\System\Domain\Collection\ConfigurationCollection')
                ->where(
                    '(domain_id = 0 AND language_id = 0) OR (domain_id = :domain_id AND language_id = 0) OR (domain_id = :domain_id AND language_id = :language_id) ORDER BY domain_id ASC, language_id ASC',
                    [
                        'domain_id'  => Utility::getSite()->getDomain()->getId(),
                        'language_id' => Utility::getSite()->getDomainUrl()->getId()
                    ]
                );
            // and merge them with the configuration we have in configuration.php
            foreach ($configurationCollection->getAll() as $configuration) {
                Utility::setConfiguration($configuration->getKey(), $configuration->getValue());
            }
        } else {
            // @TODO: check if we need to merge the config for the backend too
            // and if so, get the value from the session called 'configurationSite'
        }
        setlocale(LC_ALL, Utility::getConfiguration('System/Locale'));
        Utility::debugData(Utility::$configuration, 'config');

        return $this;
    }

    /**
     * Call the current parsed Frontend controller and action using the extension's context
     *
     * @return $this
     *
     * @throws \Continut\Core\Tools\Exception
     */
    public function connectFrontendController()
    {
        Utility::debugData('Main frontend controller called', 'start');

        $request = Utility::getRequest();
        $request->mapRouting();

        // Get request argument values or switch to default values if not defined
        $contextExtension  = $request->getArgument('_extension', 'Frontend');
        $contextController = $request->getArgument('_controller', 'Index');
        $contextAction     = $request->getArgument('_action', 'index');

        self::$renderContent = Utility::callPlugin($contextExtension, $contextController, $contextAction);

        return $this;
    }

    /**
     * Call the current parsed Backend controller and action
     *
     * @return $this
     *
     * @throws \Continut\Core\Tools\ErrorException
     */
    public function connectBackendController()
    {
        Utility::debugData('Main backend controller called', 'start');

        try {
            $request = Utility::getRequest();
            $request->mapRouting();

            // Get request argument values or switch to default values if not defined
            $contextExtension  = $request->getArgument('_extension', 'Backend');
            $contextController = $request->getArgument('_controller', 'Index');
            $contextAction     = $request->getArgument('_action', 'dashboard');

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
                $layout = Utility::createInstance('Continut\Core\System\View\BackendLayout');
                $layout->setTemplate('/Extensions/System/Backend/Resources/Private/Backend/Layouts/Default.layout.php');

                /* @var \Continut\Core\Mvc\View\PageView $pageView */
                $pageView = Utility::createInstance('Continut\Core\Mvc\View\PageView');
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
        } catch (\Exception $e) {
            throw new ErrorException('Could not finalise execution of the backend controller'.$e->getTraceAsString());
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
    public function render()
    {
        echo self::$renderContent;
    }
}
