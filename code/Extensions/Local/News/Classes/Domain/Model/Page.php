<?php

namespace Extensions\Local\News\Classes\Domain\Model {

	class Page extends \Core\Mvc\Model\BaseModel {

		protected $title;

		protected $parent;

		protected $parent_uid;

		protected $language_iso3;

		protected $is_visible;

		protected $is_deleted;

		protected $domain_uid;

		public function __construct() {
			$this->_tablename = "sys_pages";
		}

		public function getTitle() {
			return $this->title;
		}

		public function getLanguageIso3() {
			return $this->language_iso3;
		}

		public function getParentUid() {
			return $this->parent_uid;
		}

		public function getParent() {
			if (!empty($this->parent_uid)) {
				$sth = \Core\Bootstrap::getInstance()->getDatabaseHandler()->prepare("SELECT * FROM $this->_tablename WHERE uid = :parent_uid");
				$sth->execute(array(':parent_uid' => $this->parent_uid));
				$sth->setFetchMode(\PDO::FETCH_CLASS, '\\Extensions\\Local\\News\\Classes\\Domain\\Model\\Page');
				$this->parent = $sth->fetch();
			}
			return $this->parent;
		}
	}
}