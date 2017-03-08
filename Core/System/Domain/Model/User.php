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
     * @var string Serialized additional user attributes
     */
    protected $attributes;

    /**
     * @var bool is user connected
     */
    protected $isConnected = false;

    /**
     * Simple datamapper used for the database
     *
     * @return array
     */
    public function dataMapper()
    {
        $fields = [
            'username'     => $this->username,
            'password'     => $this->password,
            'usergroup_id' => $this->usergroupId,
            'is_active'    => $this->isActive,
            'is_deleted'   => $this->isDeleted,
            'attributes'   => $this->attributes
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
     *
     * @return $this
     */
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
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
     *
     * @return $this
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
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
     *
     * @return $this
     */
    public function setIsDeleted($isDeleted)
    {
        $this->isDeleted = $isDeleted;

        return $this;
    }

    /**
     * @return bool
     */
    public function getIsActive()
    {
        return $this->isActive;
    }

    /**
     * @param bool $isActive
     *
     * @return $this
     */
    public function setIsActive($isActive)
    {
        $this->isActive = $isActive;

        return $this;
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
     *
     * @return $this
     */
    public function setUsergroupId($usergroupId)
    {
        $this->usergroupId = $usergroupId;

        return $this;
    }

    /**
     * @return bool
     */
    public function getIsConnected()
    {
        return $this->isConnected;
    }

    /**
     * @param bool $isConnected
     *
     * @return $this
     */
    public function setIsConnected($isConnected)
    {
        $this->isConnected = $isConnected;

        return $this;
    }

    /**
     * Returns the list of attributes for this user
     *
     * @return array
     */
    public function getAttributes() {
        return unserialize($this->attributes);
    }

    /**
     * Return the attribute value of an attribute
     *
     * @param string $attributeName
     * @param mixed $defaultValue Value to return if the attribute is not yed defined
     * @return mixed
     */
    public function getAttribute($attributeName, $defaultValue) {
        if (in_array($attributeName, $this->getAttributes())) {
            return $this->getAttributes()[$attributeName];
        }
        return $defaultValue;
    }

    /**
     * Add an attribute value to the attributes list
     *
     * @param string $attributeName Name of the attribute
     * @param mixed  $value Value of the attribute
     *
     * @return $this
     */
    public function setAttribute($attributeName, $value) {
        $attributes = $this->getAttributes();
        $attributes[$attributeName] = $value;
        $this->attributes = serialize($attributes);

        return $this;
    }

    /**
     * You normally go through a collection to save a model, but since for the
     * user we need to frequently save their settings data, we will do so in their own
     * save method. This needs to actually be defined at the FrontendUser and BackendUser level
     */
    public function save() {
    }
}
