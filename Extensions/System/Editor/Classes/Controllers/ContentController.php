<?php
/**
 * This file is part of the Conţinut CMS project.
 * Distributed under the GNU General Public License.
 * For more details, consult the LICENSE.txt file supplied with the project
 * Author: Radu Mogoş <radu.mogos@pixelplant.ch>
 * Date: 18.09.2016 @ 11:53
 * Project: Conţinut CMS
 */
namespace Continut\Extensions\System\Editor\Classes\Controllers;

use Continut\Core\Mvc\Controller\BackendController;
use Continut\Core\Utility;

/**
 * Class ContentController
 *
 * The Frontend Editing controller that returns the page with all the required wraps for the frontend editor
 *
 * @package Continut\Extensions\System\Frontend\Classes\Controllers\Editor
 */
class ContentController extends BackendController
{
    public function __construct()
    {
        $this->setUseLayout(false);
        parent::__construct();
    }

    public function jsonAction()
    {
        $contentCollection = Utility::createInstance('Continut\Extensions\System\Backend\Classes\Domain\Collection\BackendContentCollection');

        $elements = $contentElement = $contentCollection->where("is_deleted = 0")->getAll();

        foreach ($elements as $element) {

        }

        header('Content-Type: application/json');
        return json_encode(['id' => 1, 'title' => 'Test']);
    }
}
