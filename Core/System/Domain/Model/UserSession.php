<?php
/**
 * This file is part of the Conţinut CMS project.
 * Distributed under the GNU General Public License.
 * For more details, consult the LICENSE.txt file supplied with the project
 * Author: Radu Mogoş <radu.mogos@pixelplant.ch>
 * Date: 04.04.2015 @ 20:41
 * Project: Conţinut CMS
 */
namespace Continut\Core\System\Domain\Model;

use Continut\Core\Mvc\Model\BaseModel;
use Continut\Core\Utility;

class UserSession extends BaseModel implements \SessionHandlerInterface
{
    // Available type of flash messages
    const FLASH_ERROR   = "error";
    const FLASH_WARNING = "warning";
    const FLASH_SUCCESS = "success";
    const FLASH_INFO    = "info";
    const FLASH_NOTICE  = "notice";
    const FLASH_KEY     = "flash.messages";

    /**
     * @var int Session lifetime, in seconds. Default set to 1 hour
     */
    protected $lifetime = 3600;

    /**
     * @var array List of flashmessages to show
     */
    protected $flashMessages = [];

    /**
     * @var string Table which stores our sessions
     */
    protected $tableName;

    /**
     * @var \Continut\Core\System\Domain\Model\User User instance, if connected
     */
    protected $user = null;

    /**
     * UserSession constructor
     */
    public function __construct()
    {
        $this->tableName = "sys_user_sessions";
    }

    /**
     * Open session calls
     *
     * @param string $savePath
     * @param string $sessionName
     *
     * @return bool
     */
    public function open($savePath, $sessionName)
    {
        // As the database connection is already open, we do not need to do anything special yet
        return true;
    }

    /**
     * Load Session data
     *
     * @param string $sessionId
     *
     * @return mixed
     */
    public function read($sessionId)
    {
        try {
            $sth = Utility::getDatabase()->prepare("SELECT session_data FROM $this->tableName WHERE session_id = :session_id AND session_expires >= :expire_time");
            $sth->execute([
                ":session_id" => $sessionId,
                ":expire_time" => time()
            ]);
            $sth->setFetchMode(\PDO::FETCH_ASSOC);
            $session = $sth->fetch();
        } catch (\PDOException $e) {
            return false;
        }

        return $session["session_data"];
    }

    /**
     * Save or update session data
     *
     * @param string $sessionId
     * @param string $sessionData
     *
     * @return bool
     */
    public function write($sessionId, $sessionData)
    {
        $newExpiryDate = time() + $this->lifetime;

        $sth = Utility::getDatabase()->prepare("SELECT * FROM $this->tableName WHERE session_id = :session_id");
        $sth->execute([":session_id" => $sessionId]);
        $sth->setFetchMode(\PDO::FETCH_ASSOC);

        if ($sth->rowCount() > 0) {
            $sth = Utility::getDatabase()->prepare("UPDATE $this->tableName SET session_expires = :session_expires, session_data = :session_data WHERE session_id = :session_id");
            $sth->execute(
                [
                    ":session_expires" => $newExpiryDate,
                    ":session_id"      => $sessionId,
                    ":session_data"    => $sessionData
                ]);
        } else {
            $sth = Utility::getDatabase()->prepare("INSERT INTO $this->tableName (session_id, session_expires, session_data) VALUES (:session_id, :session_expires, :session_data)");
            $sth->execute(
                [
                    ":session_id"      => $sessionId,
                    ":session_expires" => $newExpiryDate,
                    ":session_data"    => $sessionData
                ]
            );
        }

        return true;
    }

    /**
     * Delete Session data
     *
     * @param int $sessionId
     *
     * @return bool
     */
    public function destroy($sessionId)
    {
        $sth = Utility::getDatabase()->prepare("DELETE FROM $this->tableName WHERE session_id = :session_id");
        $sth->execute([":session_id" => $sessionId]);

        return ($sth->rowCount() > 0);
    }

    /**
     * @return bool
     */
    public function close()
    {
        $this->gc(ini_get('session.gc_maxlifetime'));

        return true;
    }

    /**
     * Session garbage collector
     *
     * @param int $maxLifetime
     *
     * @return bool
     */
    public function gc($maxLifetime)
    {
        $sth = Utility::getDatabase()->prepare("DELETE FROM $this->tableName WHERE session_expires < :current_time");
        $sth->execute([":current_time" => time()]);

        return ($sth->rowCount() > 0);
    }

    /**
     * Checks if a session key exists
     *
     * @param $name
     *
     * @return bool
     */
    public function has($name)
    {
        return isset($_SESSION[$name]);
    }

    /**
     * Adds a message tou our flash messages list
     *
     * @param string $value
     * @param string $type
     */
    public function addFlashMessage($value, $type = self::FLASH_SUCCESS)
    {
        $this->flashMessages = $this->get(self::FLASH_KEY);
        $this->flashMessages[$type][] = $value;
        $this->set(self::FLASH_KEY, $this->flashMessages);
    }

    /**
     * Get the value of a certain session key
     *
     * @param string $name Name of the session variable to return
     *
     * @return mixed
     */
    public function get($name)
    {
        if (isset($_SESSION[$name])) {
            return $_SESSION[$name];
        }
        return NULL;
    }

    /**
     * Set a certain session value
     *
     * @param string $name Name of key to use
     * @param mixed  $value Value to store for this key
     */
    public function set($name, $value)
    {
        $_SESSION[$name] = $value;
    }

    /**
     * Returns all defined flash messages of a certain type
     *
     * @param string $type
     *
     * @return null
     */
    public function getFlashMessages($type = self::FLASH_SUCCESS)
    {
        if (isset($this->get(self::FLASH_KEY)[$type])) {
            return $this->get(self::FLASH_KEY)[$type];
        }
        return null;
    }

    /**
     * Returns all flash messages, regardless of type
     *
     * @return mixed
     */
    public function getAllFlashMessages()
    {
        return $this->get(self::FLASH_KEY);
    }

    /**
     * Clears all currently set flash messages
     *
     * @return void
     */
    public function clearAllFlashMessages()
    {
        $this->clearFlashMessages(self::FLASH_ERROR);
        $this->clearFlashMessages(self::FLASH_WARNING);
        $this->clearFlashMessages(self::FLASH_NOTICE);
        $this->clearFlashMessages(self::FLASH_SUCCESS);
        $this->clearFlashMessages(self::FLASH_INFO);
    }

    /**
     * Clears all flash messages of a particular type
     *
     * @param string $type
     *
     * @return void
     */
    public function clearFlashMessages($type = self::FLASH_SUCCESS)
    {
        $this->flashMessages = $this->get(self::FLASH_KEY);
        if (isset($this->flashMessages[$type])) {
            unset($this->flashMessages[$type]);
            $this->set(self::FLASH_KEY, $this->flashMessages);
        }
        if (empty($this->flashMessages)) {
            $this->remove(self::FLASH_KEY);
        }
    }

    /**
     * Unset a session variable, if it is already set
     *
     * @param string $name Name of the variable to unset
     */
    public function remove($name)
    {
        if (isset($_SESSION[$name])) {
            unset($_SESSION[$name]);
        }
    }

    /**
     * @param \Continut\Core\System\Domain\Model\User $user
     */
    public function setUser($user) {
        // if the user is associated with the session it means he is already logged in so we set it as connected
        $user->setIsConnected(true);
        $this->user = $user;
    }

    /**
     * @return \Continut\Core\System\Domain\Model\User
     */
    public function getUser() {
        return $this->user;
    }
}
