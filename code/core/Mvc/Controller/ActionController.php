<?php
/**
 * This file is part of the Conţinut CMS project.
 * Distributed under the GNU General Public License.
 * For more details, consult the LICENSE.txt file supplied with the project

 * Author: Radu Mogoş <radu.mogos@pixelplant.ch>
 * Date: 29.03.2015 @ 18:43
 * Project: Conţinut CMS
 */

namespace Core\Mvc\Controller {
	use \Core\Utility;

	/**
	 * Base Controller Class, used by Frontend and Backend Controllers
	 * @package Core\Mvc\Controller
	 */
	class ActionController {

		/**
		 * Request class
		 *
		 * @var \Core\Mvc\Request
		 */
		protected $_request;

		/**
		 * @var \Core\System\Session\User Current session user
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

		protected $_arguments;

		/**
		 * @var \Core\Mvc\View\BaseView
		 */
		protected $_view;

		/**
		 * @var string The folder name where templates for this controller are stored
		 */
		protected $templateStorage;

		public function __construct() {
			$this->_view    = Utility::createInstance("\\Core\\Mvc\\View\\BaseView");
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
		 * Get view instance
		 *
		 * @return \Core\Mvc\View\BaseView
		 */
		public function getView() {
			return $this->_view;
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
		 * Deals with final rendering, once the template is fetched and parsed
		 *
		 * @return string
		 */
		public function renderView() {
			return $this->_view->render();
		}
	}
}