<?php
/**
 * This file is part of the Conținut CMS project.
 * Distributed under the GNU General Public License.
 * For more details, consult the LICENSE.txt file supplied with the project
 * Author: Radu Mogoș <radu.mogos@pixelplant.ch>
 * Date: 10/12/16 @ 10:02 AM
 * Project: Conținut CMS
 */

namespace Continut\Extensions\System\Editor\Classes\Domain\Model;

class Page extends \Continut\Core\System\Domain\Model\Page
{
    /**
     * Returns the Page data required by the Editor
     *
     * @return array
     */
    public function arrayForEditor() {
        $data = [
            'data' => [
                'id' => $this->getId(),
                'title' => $this->getTitle(),
                'isVisible' => $this->getIsVisible(),
                'slug' => $this->getSlug()
            ],
            'canDelete' => !$this->getIsDeleted(),
            'canEdit' => true,
            'canCreate' => true
        ];

        return $data;
    }
}