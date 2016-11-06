<?php
/**
 * This file is part of the Conţinut CMS project.
 * Distributed under the GNU General Public License.
 * For more details, consult the LICENSE.txt file supplied with the project
 * Author: Radu Mogoş <radu.mogos@pixelplant.ch>
 * Date: 03.04.2015 @ 20:59
 * Project: Conţinut CMS
 */
namespace Continut\Extensions\Local\News\Classes\Domain\Model;

use Continut\Core\System\Domain\Model\Content;

class NewsContent extends Content
{
    public function render()
    {
        return "<hr/> " . $this->getValue();
    }
}
