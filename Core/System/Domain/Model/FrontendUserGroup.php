<?php
/**
 * This file is part of the Conţinut CMS project.
 * Distributed under the GNU General Public License.
 * For more details, consult the LICENSE.txt file supplied with the project
 * Author: Radu Mogoş <radu.mogos@pixelplant.ch>
 * Date: 07.04.2015 @ 22:46
 * Project: Conţinut CMS
 */

namespace Continut\Core\System\Domain\Model;

use Continut\Core\Mvc\Model\BaseModel;

class FrontendUserGroup extends BaseModel
{
    /**
     * @var string UserGroup name
     */
    protected $title;

    /**
     * @var string Serialized access data
     */
    protected $access;

    /**
     * @var bool
     */
    protected $isDeleted;

    /**
     * Simple data mapper used for the database
     *
     * @return array
     */
    public function dataMapper()
    {
        $fields = [
            "title"      => $this->title,
            "access"     => $this->access,
            "is_deleted" => $this->isDeleted
        ];
        return array_merge($fields, parent::dataMapper());
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @return string
     */
    public function getAccess()
    {
        return $this->access;
    }

    /**
     * @param string $access
     */
    public function setAccess($access)
    {
        $this->access = $access;
    }

    /**
     * @return bool
     */
    public function getIsDeleted()
    {
        return $this->isDeleted;
    }

    /**
     * @param bool $isDeleted
     */
    public function setIsDeleted($isDeleted)
    {
        $this->isDeleted = $isDeleted;
    }
}
