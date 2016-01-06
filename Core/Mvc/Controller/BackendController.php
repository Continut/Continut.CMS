<?php
 /**
 * This file is part of the Conținut CMS project.
 * Distributed under the GNU General Public License.
 * For more details, consult the LICENSE.txt file supplied with the project

 * Author: Radu Mogoș <radu.mogos@pixelplant.ch>
 * Date: 01.04.2015 @ 21:30
 * Project: Conținut CMS
 */

namespace Continut\Core\Mvc\Controller {
	use \Continut\Core\Mvc\Controller\ActionController;
	use Continut\Core\Utility;

	/**
	 * Backend Controller base class. Always extends AuthenticatedController since anything in the Backend
	 * is only accessible if a user is connected
	 *
	 * @package Continut\Core\Mvc\Controller
	 */
	class BackendController extends AuthenticatedController {

		/**
		 * Backend constructor
		 */
		public function __construct() {
			parent::__construct();
			$this->setScope('Backend');
		}

		public function loginAction() {
			return "Login dude";
		}
	}
}