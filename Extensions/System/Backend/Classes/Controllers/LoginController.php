<?php
/**
 * This file is part of the Conţinut CMS project.
 * Distributed under the GNU General Public License.
 * For more details, consult the LICENSE.txt file supplied with the project
 
 * Author: Radu Mogoş <radu.mogos@pixelplant.ch>
 * Date: 27.04.2015 @ 23:42
 * Project: Conţinut CMS
 */
namespace Continut\Extensions\System\Backend\Classes\Controllers {

	use Continut\Core\Mvc\Controller\FrontendController;
	use Continut\Core\System\Session\UserSession;
	use Continut\Core\Utility;

	class LoginController extends FrontendController {

		/**
		 * The login controller uses a different layout
		 */
		public function __construct() {
			parent::__construct();
			$this->setLayoutTemplate(Utility::getResource("Default", "Backend", "Frontend", "Layout"));
		}

		/**
		 * Shows the login form
		 */
		public function indexAction() {
			if ($this->isConnected()) {
				$this->redirect(Utility::helper("Url")->linkToAction("Backend", "Index", "dashboard"));
			}
		}

		/**
		 * Checks the login data and connects the user to the backend or redirects to the login form if the credentials are incorrect
		 *
		 * @throws \Continut\Core\Tools\Exception
		 */
		public function checkLoginAction() {
			$username = $this->getRequest()->getArgument("cms_username");
			$password = $this->getRequest()->getArgument("cms_password");

			$userCollection = Utility::createInstance("Continut\\Core\\System\\Domain\\Collection\\BackendUserCollection");
			$backendUser = $userCollection->where("username = :username AND password = :password AND is_deleted = 0 AND is_active = 1",
				[
					"username" => $username,
					"password" => $password
				]
			)->getFirst();

			if (!$backendUser) {
				$this->getSession()->addFlashMessage(Utility::helper("Localization")->translate("login.error.incorrect"), UserSession::FLASH_ERROR);
				$this->redirect(Utility::helper("Url")->linkToAction("Backend", "Login", "index"));
			}

			// We set user as "connected", meaning we store their uid
			$this->getSession()->set("user_id", $backendUser->getUid());
			$this->getSession()->set("fullname", $backendUser->getName());

			// and we redirect them to the dashboard
			$this->redirect(Utility::helper("Url")->linkToAction("Backend", "Index", "dashboard"));
		}

		/**
		 * Clicking the Logout link destroys the session and reshows the login form
		 */
		public function logoutAction() {
			session_destroy();
			$this->redirect(Utility::helper("Url")->linkToAction("Backend", "Login", "index"));
		}
	}

}
