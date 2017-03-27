<?php
/**
 * This file is part of the Conţinut CMS project.
 * Distributed under the GNU General Public License.
 * For more details, consult the LICENSE.txt file supplied with the project
 * Author: Radu Mogoş <radu.mogos@pixelplant.ch>
 * Date: 09.05.2015 @ 16:55
 * Project: Conţinut CMS
 */
namespace Continut\Extensions\Local\ThemeContinutOrg\Classes\Controllers;

use Continut\Core\Mvc\Controller\BackendController;

class PreviewController extends BackendController
{
    public function notificationPreviewAction()
    {
        $this->getView()->assign('data', $this->data);
    }
}
