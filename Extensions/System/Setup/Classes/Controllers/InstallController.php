<?php
/**
 * This file is part of the Conţinut CMS project.
 * Distributed under the GNU General Public License.
 * For more details, consult the LICENSE.txt file supplied with the project
 * Author: Radu Mogoş <radu.mogos@pixelplant.ch>
 * Date: 20.04.2015 @ 21:27
 * Project: Conţinut CMS
 */
namespace Continut\Extensions\System\Setup\Classes\Controllers;

use Continut\Core\Mvc\Controller\FrontendController;
use Continut\Core\Utility;

class InstallController extends FrontendController
{
    public function __construct()
    {
        parent::__construct();
        $this->setLayoutTemplate(Utility::getResource('Setup', 'Setup', 'Frontend', 'Layout'));
    }

    public function indexAction() {

    }
}
