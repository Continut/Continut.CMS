<?php
/**
 * This file is part of the Conţinut CMS project.
 * Distributed under the GNU General Public License.
 * For more details, consult the LICENSE.txt file supplied with the project
 * Author: Radu Mogoş <radu.mogos@pixelplant.ch>
 * Date: 29.03.2015 @ 18:43
 * Project: Conţinut CMS
 */

namespace Continut\Core\Mvc\Controller {

    use Continut\Core\Utility;

    /**
     * Base Controller Class, used by Frontend and Backend Controllers
     *
     * @package Continut\Core\Mvc\Controller
     */
    class ActionController
    {
        /**
         * @var array Data, in case the controller belongs to a plugin
         */
        public $data;

        /**
         * Request class
         *
         * @var \Continut\Core\Mvc\Request
         */
        protected $request;

        /**
         * @var string Controller name
         */
        protected $name;

        /**
         * @var \Continut\Core\System\Domain\Model\User Current session user
         */
        protected $user;

        /**
         * @var string The extension this controller belongs to
         */
        protected $extension;

        /**
         * @var string Type of the extension. Can be either 'Local', 'Community' or 'System'
         */
        protected $extensionType = 'Local';

        /**
         * @var string Application scope, either 'Frontend' or 'Backend'
         */
        protected $scope = 'Frontend';

        /**
         * @var \Continut\Core\Mvc\View\BaseView
         */
        protected $view;

        /**
         * @var string The folder name where templates for this controller are stored
         */
        protected $templateStorage;

        /**
         * @var \Continut\Core\System\Domain\Model\UserSession Reference to the current user session
         */
        protected $session;

        /**
         * @var string Layout template file, if not using the one by default
         */
        protected $layoutTemplate = NULL;

        /**
         * @var \Continut\Core\Mvc\View\PageView Pageview used by controller
         */
        protected $pageView = NULL;

        /**
         * @var string Action to call on the controller, by default it is "index"
         */
        protected $action = "index";

        /**
         * @var bool Whether a layout should be used or not. No layout means the output of the controller's action is returned directly
         */
        protected $useLayout = true;

        /**
         * ActionController constructor
         */
        public function __construct()
        {
            $this->view    = Utility::createInstance('Continut\Core\Mvc\View\BaseView');
            $this->request = Utility::getRequest();
            $this->user    = Utility::getSession()->getUser();
        }

        /**
         * @return \Continut\Core\Mvc\View\PageView
         */
        public function getPageView()
        {
            return $this->pageView;
        }

        /**
         * @param \Continut\Core\Mvc\View\PageView $pageView
         */
        public function setPageView($pageView)
        {
            $this->pageView = $pageView;
        }

        /**
         * @return \Continut\Core\System\Domain\Model\User
         */
        public function getUser()
        {
            return $this->user;
        }

        /**
         * @return string
         */
        public function getLayoutTemplate()
        {
            return $this->layoutTemplate;
        }

        /**
         * @param string $layoutTemplate
         */
        public function setLayoutTemplate($layoutTemplate)
        {
            $this->layoutTemplate = $layoutTemplate;
        }

        /**
         * Returns the final render from the action called, or it's rendered template
         *
         * @return string
         * @throws \Continut\Core\Tools\Exception
         */
        public function getRenderOutput()
        {
            $action = $this->action . "Action";
            $viewContent = $this->$action();

            if (empty($viewContent)) {
                $viewContent = $this->view->render();
            }

            return $viewContent;
        }

        /**
         * If an user_id is stored in our session it means that our user is connected
         *
         * @return bool
         */
        public function isConnected()
        {
            return $this->getSession()->get("user_id");
        }

        /**
         * Get user session
         *
         * @return \Continut\Core\System\Domain\Model\UserSession
         */
        public function getSession()
        {
            return Utility::getSession();
        }

        /**
         * Get request object
         *
         * @return \Continut\Core\Mvc\Request
         */
        public function getRequest()
        {
            return $this->request;
        }

        /**
         * Set request object. Should only by called by system or bootstrap scripts
         *
         * @param $request
         *
         * @return $this
         */
        public function setRequest($request)
        {
            $this->request = $request;

            return $this;
        }

        /**
         * @return string Extension type, be it Local or System
         */
        public function getExtensionType()
        {
            return $this->extensionType;
        }

        /**
         * @param string Set extension type
         *
         * @return $this
         */
        public function setExtensionType($extensionType)
        {
            $this->extensionType = $extensionType;

            return $this;
        }

        /**
         * Deals with final rendering, once the template is fetched and parsed
         *
         * @return string
         */
        public function renderView()
        {
            return $this->view->render();
        }

        /**
         * Redirect call to another controller/action
         *
         * @param string $to
         * @param int    $status
         */
        public function redirect($to, $status = 301)
        {
            header("Location: $to", true, $status);
        }

        /**
         * Forward current action to another one
         *
         * @param $to Action name to forward to
         *
         * @throws ErrorException
         */
        public function forward($to)
        {
            $this->setAction($to);

            $templateController = $this->getName();
            $templateAction = $this->getAction();
            $contextExtension = $this->getExtension();
            $contextScope = $this->getScope();
            $contextAction = $this->getAction() . "Action";

            $this
                ->getView()
                ->setTemplate(
                    Utility::getResource("$templateController/$templateAction", $contextExtension, $contextScope, "Template")
                );

            if (!method_exists($this, $contextAction)) {
                throw new ErrorException("The action you are trying to call does not exist for this controller", 30000002);
            }

            $this->$contextAction();
        }

        /**
         * @return string
         */
        public function getName()
        {
            return $this->name;
        }

        /**
         * @param string $name
         *
         * @return $this
         */
        public function setName($name)
        {
            $this->name = $name;

            return $this;
        }

        /**
         * @return string
         */
        public function getAction()
        {
            return $this->action;
        }

        /**
         * @param string $action
         *
         * @return $this
         */
        public function setAction($action)
        {
            $this->action = $action;

            return $this;
        }

        /**
         * @return string Extension name where this controller resides
         */
        public function getExtension()
        {
            return $this->extension;
        }

        /**
         * Set the controller's extension and scope
         *
         * @param        $extension
         * @param string $extensionType
         *
         * @return $this
         */
        public function setExtension($extension, $extensionType = 'Local')
        {
            $this->extension = $extension;
            $this->extensionType = $extensionType;

            return $this;
        }

        /**
         * Controller scope
         *
         * @return string
         */
        public function getScope()
        {
            return $this->scope;
        }

        /**
         * Set Controller scope
         *
         * @param string $scope
         *
         * @return $this
         */
        public function setScope($scope = 'Frontend')
        {
            $this->scope = $scope;

            return $this;
        }

        /**
         * Get view instance
         *
         * @return \Continut\Core\Mvc\View\BaseView
         */
        public function getView()
        {
            return $this->view;
        }

        /**
         * @return boolean
         */
        public function getUseLayout()
        {
            return $this->useLayout;
        }

        /**
         * @param boolean $useLayout
         */
        public function setUseLayout($useLayout)
        {
            $this->useLayout = $useLayout;
        }

        /**
         * Returns a translated label
         *
         * @param string $label
         * @param array  $arguments
         *
         * @return string
         */
        public function __($label, $arguments = NULL)
        {
            return Utility::helper("Localization")->translate($label, $arguments);
        }
    }
}
