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
		protected $request;

		protected $response;

		protected $arguments;

		/**
		 * @var string The folder name where templates for this controller are stored
		 */
		protected $templateStorage;

		public function __construct() {
			$this->request = new \Core\Mvc\Request();
		}

		/**
		 * Get request object
		 *
		 * @return \Core\Mvc\Request
		 */
		public function getRequest() {
			return $this->request;
		}
	}
}