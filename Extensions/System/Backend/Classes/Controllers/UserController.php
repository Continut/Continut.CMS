<?php
/**
 * This file is part of the Conţinut CMS project.
 * Distributed under the GNU General Public License.
 * For more details, consult the LICENSE.txt file supplied with the project
 * Author: Radu Mogoş <radu.mogos@pixelplant.ch>
 * Date: 31.12.2015 @ 14:46
 * Project: Conţinut CMS
 */
namespace Continut\Extensions\System\Backend\Classes\Controllers;

use Continut\Core\Mvc\Controller\BackendController;
use Continut\Core\Utility;

class UserController extends BackendController
{
    public function __construct()
    {
        parent::__construct();
        $this->setLayoutTemplate(Utility::getResource("Default", "Backend", "Backend", "Layout"));
    }

    public function profileAction()
    {
        $this->getView()->assign('user', $this->getUser());
    }
}
