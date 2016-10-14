<?php
/**
 * This file is part of the Conţinut CMS project.
 * Distributed under the GNU General Public License.
 * For more details, consult the LICENSE.txt file supplied with the project
 * Author: Radu Mogoş <radu.mogos@pixelplant.ch>
 * Date: 04.04.2015 @ 20:46
 * Project: Conţinut CMS
 */
namespace Continut\Core\System\Domain\Model;

use Continut\Core\Mvc\Model\BaseModel;

class User extends BaseModel
{
    /**
     * @var string Username
     */
    protected $username;

    /**
     * @var string password
     */
    protected $password;

    /**
     * @var bool is user deleted
     */
    protected $isDeleted;

    /**
     * @var bool is user currently active
     */
    protected $isActive;

    /**
     * @var int Usergroup id
     */
    protected $usergroupId;

    /**
     * Simple datamapper used for the database
     *
     * @return array
     */
    public function dataMapper()
    {
        $fields = [
            "username"     => $this->username,
            "password"     => $this->password,
            "usergroup_id" => $this->usergroupId,
            "is_active"    => $this->isActive,
            "is_deleted"   => $this->isDeleted,
            "name"         => $this->name
        ];

        return array_merge($fields, parent::dataMapper());
    }

    /**
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param string $username
     */
    public function setUsername($username)
    {
        $this->username = $username;
    }

    /**
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    /**
     * @return boolean
     */
    public function isIsDeleted()
    {
        return $this->isDeleted;
    }

    /**
     * @param boolean $isDeleted
     */
    public function setIsDeleted($isDeleted)
    {
        $this->isDeleted = $isDeleted;
    }

    /**
     * @return boolean
     */
    public function isIsActive()
    {
        return $this->isActive;
    }

    /**
     * @param boolean $isActive
     */
    public function setIsActive($isActive)
    {
        $this->isActive = $isActive;
    }

    /**
     * @return int
     */
    public function getUsergroupId()
    {
        return $this->usergroupId;
    }

    /**
     * @param int $usergroupId
     */
    public function setUsergroupId($usergroupId)
    {
        $this->usergroupId = $usergroupId;
    }
}
