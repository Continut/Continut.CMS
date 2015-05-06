<?php
/**
 * This file is part of the Conţinut CMS project.
 * Distributed under the GNU General Public License.
 * For more details, consult the LICENSE.txt file supplied with the project
 
 * Author: Radu Mogoş <radu.mogos@pixelplant.ch>
 * Date: 04.04.2015 @ 20:41
 * Project: Conţinut CMS
 */
namespace Core\System\Session {

	use Core\Mvc\Model\BaseModel;
	use Core\Utility;

	class UserSession extends BaseModel implements \SessionHandlerInterface {

		/**
		 * @var int Session lifetime, in seconds. Default set to 1 hour
		 */
		protected $_lifetime = 3600;

		public function __construct() {
			$this->_tablename = "sys_user_sessions";
		}

		/**
		 * Open session calls
		 *
		 * @param string $savePath
		 * @param string $name
		 *
		 * @return bool
		 */
		public function open($savePath, $name) {
			// As the database connection is already open, we do not need to do anything special yet
			return TRUE;
		}

		/**
		 * Load Session data
		 *
		 * @param string $sessionId
		 *
		 * @return mixed
		 */
		public function read($sessionId) {
			$sth = Utility::getDatabase()->prepare("SELECT session_data FROM $this->_tablename WHERE session_id = :session_id AND session_expires >= :expire_time");
			$sth->execute([
				":session_id" => $sessionId,
				":expire_time" => time()
			]);
			$sth->setFetchMode(\PDO::FETCH_ASSOC);
			$session = $sth->fetch();

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
		public function write($sessionId, $sessionData) {
			$newExpiryDate = time() + $this->_lifetime;

			$sth = Utility::getDatabase()->prepare("SELECT * FROM $this->_tablename WHERE session_id = :session_id");
			$sth->execute([":session_id" => $sessionId]);
			$sth->setFetchMode(\PDO::FETCH_ASSOC);

			if ($sth->rowCount() > 0) {
				$sth = Utility::getDatabase()->prepare("UPDATE $this->_tablename SET session_expires = :session_expires, session_data = :session_data WHERE session_id = :session_id");
				$sth->execute(
					[
						":session_expires" => $newExpiryDate,
						":session_id"      => $sessionId,
						":session_data"    => $sessionData
					]);
				if ($sth->rowCount() > 0) {
					return TRUE;
				}
			} else {
				$sth = Utility::getDatabase()->prepare("INSERT INTO $this->_tablename (session_id, session_expires, session_data) VALUES (:session_id, :session_expires, :session_data)");
				$sth->execute(
						[
							":session_id"      => $sessionId,
							":session_expires" => $newExpiryDate,
							":session_data"    => $sessionData
						]
					);
				if ($sth->rowCount() > 0) {
					return TRUE;
				}
			}

			// if an error occured, return false
			return FALSE;
		}

		/**
		 * Delete Session data
		 *
		 * @param int $sessionId
		 *
		 * @return bool
		 */
		public function destroy($sessionId) {
			$sth = Utility::getDatabase()->prepare("DELETE FROM $this->_tablename WHERE session_id = :session_id");
			$sth->execute([":session_id" => $sessionId]);

			return ($sth->rowCount() > 0);
		}

		/**
		 * Session garbage collector
		 *
		 * @param int $maxLifetime
		 *
		 * @return bool
		 */
		public function gc($maxLifetime) {
			$sth = Utility::getDatabase()->prepare("DELETE FROM $this->_tablename WHERE session_expires < :current_time");
			$sth->execute([":current_time" => time()]);

			return ($sth->rowCount() > 0);
		}

		public function close() {
			$this->gc(ini_get('session.gc_maxlifetime'));
		}

		/**
		 * Set a certain session value
		 *
		 * @param string $name  Name of key to use
		 * @param mixed  $value Value to store for this key
		 */
		public function set($name, $value) {
			$_SESSION[$name] = $value;
		}

		/**
		 * Get the value of a certain session key
		 *
		 * @param string $name Name of the session variable to return
		 *
		 * @return mixed
		 */
		public function get($name) {
			if (isset($_SESSION[$name])) {
				return $_SESSION[$name];
			}
			return NULL;
		}

		/**
		 * Unset a session variable, if it is already set
		 *
		 * @param string $name Name of the variable to unset
		 */
		public function remove($name) {
			if (isset($_SESSION[$name])) {
				unset($_SESSION[ $name ]);
			}
		}
	}

}
