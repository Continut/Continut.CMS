<?php
/**
 * This file is part of the Conţinut CMS project.
 * Distributed under the GNU General Public License.
 * For more details, consult the LICENSE.txt file supplied with the project

 * Author: Radu Mogoş <radu.mogos@pixelplant.ch>
 * Date: 29.03.2015 @ 19:20
 * Project: Conţinut CMS
 */

namespace Continut\Core\Mvc\Controller {
	use \Continut\Core\Mvc\Controller\ActionController;

	/**
	 * Frontend Controller base class
	 *
	 * @package Continut\Core\Mvc\Controller
	 */
	class FrontendController extends ActionController {

		/**
		 * Frontend constructor
		 */
		public function __construct() {
			parent::__construct();
			$this->setScope('Frontend');
		}
	}
}