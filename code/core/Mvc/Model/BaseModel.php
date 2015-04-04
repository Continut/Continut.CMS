<?php
/**
 * This file is part of the Conţinut CMS project.
 * Distributed under the GNU General Public License.
 * For more details, consult the LICENSE.txt file supplied with the project

 * Author: Radu Mogoş <radu.mogos@pixelplant.ch>
 * Date: 29.03.2015 @ 18:43
 * Project: Conţinut CMS
 */

namespace Core\Mvc\Model {
	use Core\Utility;

	/**
	 * Class BaseModel
	 *
	 * @package Core\Mvc\Model
	 */
	class BaseModel {
		/**
		 * @var int model unique identifier
		 */
		protected $uid;

		/**
		 * @var string name of the table the model is associated to
		 */
		protected $_tablename;

		public function __construct() {
			$this->setTablename();
		}

		/**
		 * @return int Model's unique id in the database
		 */
		public function getUid() {
			return $this->uid;
		}

		public function findByUid($uid) {
			$sth = Utility::database()->prepare("SELECT * FROM $this->_tablename WHERE uid = :uid");
			$sth->execute([':uid' => $uid]);
			$sth->setFetchMode(\PDO::FETCH_CLASS, get_class($this));
			return $sth->fetch();
		}

		public function save() {

		}
	}
}