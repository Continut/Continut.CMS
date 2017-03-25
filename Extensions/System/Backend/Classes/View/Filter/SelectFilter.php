<?php
/**
 * This file is part of the Conţinut CMS project.
 * Distributed under the GNU General Public License.
 * For more details, consult the LICENSE.txt file supplied with the project
 * Author: Radu Mogoş <radu.mogos@pixelplant.ch>
 * Date: 03.01.2016 @ 13:40
 * Project: Conţinut CMS
 */

namespace Continut\Extensions\System\Backend\Classes\View\Filter;

use Continut\Core\Utility;

class SelectFilter extends BaseFilter
{
    /**
     * TextFilter constructor
     */
    public function __construct()
    {
        $this->setTemplate(Utility::getResourcePath('Filter/select', 'Backend', 'Backend', 'Template'));
    }

    /**
     * @return string
     */
    public function getQueryText()
    {
        $fieldName = $this->getField()->getDatabaseColumn();
        if ($this->getField()->getValue() != null) {
            return "$fieldName = :$fieldName";
        }
    }

    /**
     * @return array
     */
    public function getQueryValue()
    {
        $filterValue = $this->getField()->getValue();
        if ($filterValue != null) {
            return [$this->getField()->getDatabaseColumn() => $filterValue];
        }
    }
}
