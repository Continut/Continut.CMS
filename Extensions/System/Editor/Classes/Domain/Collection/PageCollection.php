<?php
/**
 * This file is part of the Conținut CMS project.
 * Distributed under the GNU General Public License.
 * For more details, consult the LICENSE.txt file supplied with the project
 * Author: Radu Mogoș <radu.mogos@pixelplant.ch>
 * Date: 10/12/16 @ 10:06 AM
 * Project: Conținut CMS
 */

namespace Continut\Extensions\System\Editor\Classes\Domain\Collection;

class PageCollection extends \Continut\Core\System\Domain\Collection\PageCollection
{
    /**
     * Set tablename and each element's class
     */
    public function __construct()
    {
        parent::__construct();
        // we overwrite just the element class
        $this->elementClass = 'Continut\Extensions\System\Editor\Classes\Domain\Model\Page';
    }
}