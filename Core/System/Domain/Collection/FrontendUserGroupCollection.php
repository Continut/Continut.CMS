<?php
/**
 * This file is part of the Conţinut CMS project.
 * Distributed under the GNU General Public License.
 * For more details, consult the LICENSE.txt file supplied with the project
 * Author: Radu Mogoş <radu.mogos@pixelplant.ch>
 * Date: 27.04.2015 @ 22:30
 * Project: Conţinut CMS
 */
namespace Continut\Core\System\Domain\Collection;

use Continut\Core\Mvc\Model\BaseCollection;

class FrontendUserGroupCollection extends BaseCollection
{
    /**
     * Set tablename and element class
     */
    public function __construct()
    {
        $this->tablename = 'sys_frontend_usergroups';
        $this->elementClass = 'Continut\Core\System\Domain\Model\FrontendUserGroup';
    }
}
