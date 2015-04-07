<?php
 /**
 * This file is part of the Conținut CMS project.
 * Distributed under the GNU General Public License.
 * For more details, consult the LICENSE.txt file supplied with the project

 * Author: Radu Mogoș <radu.mogos@pixelplant.ch>
 * Date: 01.04.2015 @ 21:30
 * Project: Conținut CMS
 */

namespace Core\Mvc\Controller {
	use \Core\Mvc\Controller\ActionController;
	use Core\Utility;

	/**
	 * Backend Controller base class
	 *
	 * @package Core\Mvc\Controller
	 */
	class BackendController extends ActionController {

		/**
		 * Backend constructor
		 */
		public function __construct() {
			parent::__construct();
			$this->setScope('Backend');
		}
	}
}