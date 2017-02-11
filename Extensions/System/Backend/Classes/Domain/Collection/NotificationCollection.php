<?php
/**
 * This file is part of the Conţinut CMS project.
 * Distributed under the GNU General Public License.
 * For more details, consult the LICENSE.txt file supplied with the project
 * Author: Radu Mogoş <radu.mogos@pixelplant.ch>
 * Date: 10.02.2018 @ 18:04
 * Project: Conţinut CMS
 */

namespace Continut\Extensions\System\Backend\Classes\Domain\Collection;

use Continut\Core\Mvc\Model\BaseCollection;

class NotificationCollection extends BaseCollection
{
    /**
     * Set tablename and element class for this collection
     */
    public function __construct()
    {
        $this->tablename = 'sys_notifications';
        $this->elementClass = 'Continut\Extensions\System\Backend\Classes\Domain\Model\Notification';
    }
}
