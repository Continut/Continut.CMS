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
			$this->_view = new \Core\Mvc\View\BaseView();
			$this->_request = new \Core\Mvc\Request();
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
		 * @return $this
		 */
		public function render() {
			return $this;
		}
	}
}