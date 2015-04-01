<?php

namespace Core\Mvc\Model {

	class BaseModel {
		protected $uid;

		protected $_tablename;

		public function __constructor($tablename) {
			$this->tablename = $tablename;
		}

		public function findByUid($uid) {
			$sth = \Core\Bootstrap::getInstance()->getDatabaseHandler()->prepare("SELECT * FROM $this->_tablename WHERE uid = :uid");
			$sth->execute(array(':uid' => $uid));
			$sth->setFetchMode(\PDO::FETCH_CLASS, get_class($this));
			return $sth->fetch();
		}
	}
}