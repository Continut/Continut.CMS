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
	 * @package Continut\Core\Mvc\Controller
	 */
	class ActionController {

		/**
		 * Request class
		 *
		 * @var Continut\Core\Mvc\Request
		 */
		protected $_request;

		/**
		 * @var string Controller name
		 */
		protected $_name;

		/**
		 * @var Continut\Core\System\Session\User Current session user
		 */
		protected $_user;

		/**
		 * @var string The extension this controller belongs to
		 */
		protected $_extension;

		/**
		 * @var string Type of the extension. Can be either 'Local', 'Community' or 'System'
		 */
		protected $_extensionType = 'Local';

		/**
		 * @var string Application scope, either 'Frontend' or 'Backend'
		 */
		protected $_scope = 'Frontend';

		protected $_response;

		/**
		 * @var \Core\Mvc\View\BaseView
		 */
		protected $_view;

		/**
		 * @var string The folder name where templates for this controller are stored
		 */
		protected $templateStorage;

		/**
		 * @var array Data, in case the controller belongs to a plugin
		 */
		public $data;

		/**
		 * @var \Core\System\Session\UserSession Reference to the current user session
		 */
		protected $_session;

		/**
		 * @var string Layout template file, if not using the one by default
		 */
		protected $_layoutTemplate = NULL;

		/**
		 * @var string Action to call on the controller, by default it is "index"
		 */
		protected $_action = "index";

		public function __construct() {
			$this->_view    = Utility::createInstance('Continut\Core\Mvc\View\BaseView');
			$this->_request = Utility::getRequest();
			//$this->_user    = Utility::getUser();
		}

		/**
		 * @return \Core\System\Session\User
		 */
		public function getUser() {
			return $this->_user;
		}

		/**
		 * @return string
		 */
		public function getLayoutTemplate()
		{
			return $this->_layoutTemplate;
		}

		/**
		 * @param string $layoutTemplate
		 */
		public function setLayoutTemplate($layoutTemplate)
		{
			$this->_layoutTemplate = $layoutTemplate;
		}

		/**
		 * @return string
		 */
		public function getAction()
		{
			return $this->_action;
		}

		/**
		 * @param string $action
		 *
		 * @return $this
		 */
		public function setAction($action)
		{
			$this->_action = $action;

			return $this;
		}

		/**
		 * Get view instance
		 *
		 * @return \Core\Mvc\View\BaseView
		 */
		public function getView() {
			return $this->_view;
		}

		/**
		 * Returns the final render from the action called, or it's rendered template
		 *
		 * @return string
		 * @throws \Core\Tools\Exception
		 */
		public function getRenderOutput() {
			$action = $this->_action . "Action";
			$viewContent = $this->$action();

			if (empty($viewContent)) {
				$viewContent = $this->_view->render();
			}

			return $viewContent;
		}

		/**
		 * Get user session
		 *
		 * @return \Core\System\Session\UserSession
		 */
		public function getSession() {
			return Utility::getSession();
		}

		/**
		 * If an user_id is stored in our session it means that our user is connected
		 *
		 * @return bool
		 */
		public function isConnected() {
			return $this->getSession()->get("user_id");
		}

		/**
		 * Set request object. Should only by called by system or bootstrap scripts
		 *
		 * @param $request
		 *
		 * @return $this
		 */
		public function setRequest($request) {
			$this->_request = $request;

			return $this;
		}

		/**
		 * Get request object
		 *
		 * @return \Core\Mvc\Request
		 */
		public function getRequest() {
			return $this->_request;
		}

		/**
		 * Set the controller's extension and scope
		 *
		 * @param        $extension
		 * @param string $extensionType
		 *
		 * @return $this
		 */
		public function setExtension($extension, $extensionType = 'Local') {
			$this->_extension = $extension;
			$this->_extensionType = $extensionType;

			return $this;
		}

		/**
		 * @return string Extension name where this controller resides
		 */
		public function getExtension() {
			return $this->_extension;
		}

		/**
		 * @param string Set extension type
		 *
		 * @return $this
		 */
		public function setExtensionType($extensionType) {
			$this->_extensionType = $extensionType;

			return $this;
		}

		/**
		 * @return string Extension type, be it Local or System
		 */
		public function getExtensionType() {
			return $this->_extensionType;
		}

		/**
		 * Set Controller scope
		 *
		 * @param string $scope
		 *
		 * @return $this
		 */
		public function setScope($scope = 'Frontend') {
			$this->_scope = $scope;

			return $this;
		}

		/**
		 * Controller scope
		 *
		 * @return string
		 */
		public function getScope() {
			return $this->_scope;
		}

		/**
		 * Deals with final rendering, once the template is fetched and parsed
		 *
		 * @return string
		 */
		public function renderView() {
			return $this->_view->render();
		}

		/**
		 * Redirect call to another controller/action
		 * @param string $to
		 * @param int    $status
		 */
		public function redirect($to, $status = 301) {
			header("Location: $to", true, $status);
		}

		/**
		 * Forward current action to another one
		 *
		 * @param $to Action name to forward to
		 *
		 * @throws ErrorException
		 */
		public function forward($to) {
			$this->setAction($to);

			$templateController = $this->getName();
			$templateAction     = $this->getAction();
			$contextExtension   = $this->getExtension();
			$contextScope       = $this->getScope();
			$contextAction      = $this->getAction() . "Action";

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
		 * Returns a translated label
		 * @param string $label
		 * @param array  $arguments
		 *
		 * @return string
		 */
		public function __($label, $arguments = NULL) {
			return Utility::helper("Localization")->translate($label, $arguments);
		}

		/**
		 * @return string
		 */
		public function getName()
		{
			return $this->_name;
		}

		/**
		 * @param string $name
		 *
		 * @return $this
		 */
		public function setName($name)
		{
			$this->_name = $name;

			return $this;
		}
	}
}