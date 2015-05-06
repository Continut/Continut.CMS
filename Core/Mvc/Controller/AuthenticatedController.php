<?php
/**
 * This file is part of the Conţinut CMS project.
 * Distributed under the GNU General Public License.
 * For more details, consult the LICENSE.txt file supplied with the project
 
 * Author: Radu Mogoş <radu.mogos@pixelplant.ch>
 * Date: 27.04.2015 @ 22:55
 * Project: Conţinut CMS
 */
namespace Core\Mvc\Controller {

	use Core\Utility;

	class AuthenticatedController extends ActionController {
		public function __construct() {
			parent::__construct();
			if (!$this->isConnected()) {
				$this->redirect(Utility::helper("Url")->linkToAction("Backend", "Login", "index"));
			}
		}
	}

}
