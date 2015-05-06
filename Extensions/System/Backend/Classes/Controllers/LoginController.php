<?php
/**
 * This file is part of the Conţinut CMS project.
 * Distributed under the GNU General Public License.
 * For more details, consult the LICENSE.txt file supplied with the project
 
 * Author: Radu Mogoş <radu.mogos@pixelplant.ch>
 * Date: 27.04.2015 @ 23:42
 * Project: Conţinut CMS
 */
namespace Extensions\System\Backend\Classes\Controllers {

	use Core\Mvc\Controller\FrontendController;
	use Core\Utility;

	class LoginController extends FrontendController {

		public function __construct() {
			parent::__construct();
			$this->setLayoutTemplate(Utility::getResource("Default", "Backend", "Frontend", "Layout"));
		}

		public function indexAction() {

		}

		public function checkLoginAction() {
			$username = $this->getRequest()->getArgument("cms_username");
			$password = $this->getRequest()->getArgument("cms_password");

			$userCollection = Utility::createInstance("Core\\System\\Domain\\Collection\\BackendUserCollection");
			$backendUser = $userCollection->where("username = :username AND password = :password AND is_deleted = 0 AND is_active = 1",
				[
					"username" => $username,
					"password" => $password
				]
			)->getFirst();

			if (!$backendUser) {
				$this->redirect(Utility::helper("Url")->linkToAction("Backend", "Login", "index"));
			}

			// We set user as "connected", meaning we store their uid
			$this->getSession()->set("user_id", $backendUser->getUid());
			$this->getSession()->set("fullname", $backendUser->getName());

			// and we redirect them to the dashboard
			$this->redirect(Utility::helper("Url")->linkToAction("Backend", "Index", "dashboard"));
		}
	}

}
