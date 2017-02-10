<?php
/**
 * This file is part of the Conţinut CMS project.
 * Distributed under the GNU General Public License.
 * For more details, consult the LICENSE.txt file supplied with the project
 * Author: Radu Mogoş <radu.mogos@pixelplant.ch>
 * Date: 10.02.2017 @ 18:00
 * Project: Conţinut CMS
 */
namespace Continut\Core\System\Domain\Model;

use Continut\Core\Mvc\Model\BaseModel;

class Notification extends BaseModel
{
    /**
     * @var string
     */
    protected $link;

    /**
     * @var \Continut\Core\System\Domain\Model\BackendUser
     */
    protected $user;

    /**
     * @var int
     */
    protected $createdAt;

    /**
     * @var string
     */
    protected $message;

    /**
     * Simple datamapper used for the database
     *
     * @return array
     */
    public function dataMapper()
    {
        $fields = [
            "created_at" => $this->createdAt,
            "user"       => $this->user,
            "link"       => $this->link,
            "message"    => $this->message,
        ];
        return array_merge($fields, parent::dataMapper());
    }

    /**
     * @return string
     */
    public function getLink()
    {
        return $this->link;
    }

    /**
     * @param string $link
     */
    public function setLink($link)
    {
        $this->link = $link;
    }

    /**
     * @return BackendUser
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param BackendUser $user
     */
    public function setUser($user)
    {
        $this->user = $user;
    }

    /**
     * @return int
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @param int $createdAt
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
    }

    /**
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * @param string $message
     */
    public function setMessage($message)
    {
        $this->message = $message;
    }
}
