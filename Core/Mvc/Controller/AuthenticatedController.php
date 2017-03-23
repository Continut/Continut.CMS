<?php
/**
 * This file is part of the Conţinut CMS project.
 * Distributed under the GNU General Public License.
 * For more details, consult the LICENSE.txt file supplied with the project
 * Author: Radu Mogoş <radu.mogos@pixelplant.ch>
 * Date: 27.04.2015 @ 22:55
 * Project: Conţinut CMS
 */

namespace Continut\Core\Mvc\Controller;

use Continut\Core\Utility;

class AuthenticatedController extends ActionController
{
    /**
     * Check if the BE user is still connected, otherwise redirect him to the login page
     */
    public function __construct()
    {
        parent::__construct();
        if (!$this->isConnected()) {
            $url = Utility::helper('Url')->linkToPath('admin_backend', ['_controller' => 'Login', '_action' => 'index']);
            if ($this->getRequest()->isAjax()) {
                //echo "<script>window.location = '$url';</script>";
                header('Continut-Redirect: ' . $url);
                //die();
            } else {
                $this->redirect($url);
            }
        }
    }
}
