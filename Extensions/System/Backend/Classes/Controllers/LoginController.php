<?php
/**
 * This file is part of the Conţinut CMS project.
 * Distributed under the GNU General Public License.
 * For more details, consult the LICENSE.txt file supplied with the project
 * Author: Radu Mogoş <radu.mogos@pixelplant.ch>
 * Date: 27.04.2015 @ 23:42
 * Project: Conţinut CMS
 */
namespace Continut\Extensions\System\Backend\Classes\Controllers;

use Continut\Core\Mvc\Controller\FrontendController;
use Continut\Core\System\Domain\Model\UserSession;
use Continut\Core\Utility;

class LoginController extends FrontendController
{
    /**
     * The login controller uses a different layout
     */
    public function __construct()
    {
        parent::__construct();
        $this->setLayoutTemplate(Utility::getResourcePath('Default', 'Backend', 'Frontend', 'Layout'));
    }

    /**
     * Shows the login form
     */
    public function indexAction()
    {
        if ($this->isConnected()) {
            $this->redirect(Utility::helper('Url')->LinkToPath('admin'));
        }
    }

    /**
     * Checks the login data and connects the user to the backend or redirects to the login form if the credentials are incorrect
     *
     * @throws \Continut\Core\Tools\Exception
     */
    public function checkLoginAction()
    {
        $username = $this->getRequest()->getArgument("cms_username");
        $password = $this->getRequest()->getArgument("cms_password");

        $userCollection = Utility::createInstance('Continut\Core\System\Domain\Collection\BackendUserCollection');
        $backendUser = $userCollection->where("username = :username AND is_deleted = 0 AND is_active = 1",
            [
                "username" => $username,
                //"password" => $password
            ]
        )->getFirst();

        if (!$backendUser || !password_verify($password, $backendUser->getPassword())) {
            $this->getSession()->addFlashMessage(Utility::helper("Localization")->translate("login.error.incorrect"), UserSession::FLASH_ERROR);
            $this->redirect(Utility::helper("Url")->linkToPath('admin', ['_controller' => 'Login', '_action' => 'index']));
        }

        // We set user as "connected", meaning we store their id
        $this->getSession()->set("user_id", $backendUser->getId());

        // and we redirect them to the dashboard
        $this->redirect(Utility::helper("Url")->linkToPath('admin'));
    }

    /**
     * Clicking the Logout link destroys the session and reshows the login form
     */
    public function logoutAction()
    {
        session_destroy();
        $this->redirect(Utility::helper("Url")->linkToPath('admin', ['_controller' => 'Login', '_action' => 'index']));
    }
}
