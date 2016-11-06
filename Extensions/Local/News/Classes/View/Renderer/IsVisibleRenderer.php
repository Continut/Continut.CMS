<?php
/**
 * This file is part of the Conţinut CMS project.
 * Distributed under the GNU General Public License.
 * For more details, consult the LICENSE.txt file supplied with the project
 * Author: Radu Mogoş <radu.mogos@pixelplant.ch>
 * Date: 03.01.2016 @ 15:00
 * Project: Conţinut CMS
 */
namespace Continut\Extensions\Local\News\Classes\View\Renderer;

use Continut\Core\Utility;
use Continut\Extensions\System\Backend\Classes\View\Renderer\BaseRenderer;

class IsVisibleRenderer extends BaseRenderer
{
    /**
     * TextFilter constructor
     */
    public function __construct()
    {
        $this->setTemplate(Utility::getResource('Renderer/isVisible', 'News', 'Backend', 'Template'));
    }
}
