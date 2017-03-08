<?php
/**
 * This file is part of the Conţinut CMS project.
 * Distributed under the GNU General Public License.
 * For more details, consult the LICENSE.txt file supplied with the project
 * Author: Radu Mogoş <radu.mogos@pixelplant.ch>
 * Date: 27.04.2015 @ 22:27
 * Project: Conţinut CMS
 */

namespace Continut\Core\System\Domain\Model;

use Continut\Core\Utility;

class FrontendUser extends User
{
    /**
     * Save FrontendUser data
     */
    public function save()
    {
        $collection = Utility::createInstance('Continut\Core\System\Domain\Collection\FrontendUserCollection');
        $collection->add($this)->save();
    }
}
