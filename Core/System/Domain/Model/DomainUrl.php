<?php
/**
 * This file is part of the Conţinut CMS project.
 * Distributed under the GNU General Public License.
 * For more details, consult the LICENSE.txt file supplied with the project
 * Author: Radu Mogoş <radu.mogos@pixelplant.ch>
 * Date: 08.08.2015 @ 14:58
 * Project: Conţinut CMS
 */
namespace Core\System\Domain\Model {

	use Core\Mvc\Model\BaseModel;
	use Core\Utility;

	class DomainUrl extends BaseModel {

		/**
		 * @var boolean
		 */
		protected $is_alias;

		/**
		 * @var int
		 */
		protected $parent_uid;

		/**
		 * @var int
		 */
		protected $domain_uid;

		/**
		 * @var string
		 */
		protected $url;

		/**
		 * @var int
		 */
		protected $sorting;

		/**
		 * @var string ISO2 code used for the flag
		 */
		protected $flag;

		/**
		 * @var string Locale used by this domain url
		 */
		protected $locale;

		/**
		 * @var Core\System\Domain\Model\Domain
		 */
		protected $domain = NULL;

		/**
		 * @var string
		 */
		protected $title;

		/**
		 * Simple datamapper used for the database
		 * @return array
		 */
		public function dataMapper() {
			return [
				"is_alias"      => $this->is_alias,
				"parent_uid"    => $this->parent_uid,
				"domain_uid"    => $this->domain_uid,
				"sorting"       => $this->sorting,
				"locale"        => $this->locale,
				"flag"          => $this->flag,
				"url"           => $this->url,
				"title"         => $this->title
			];
		}

		/**
		 * @return boolean
		 */
		public function getIsAlias()
		{
			return $this->is_alias;
		}

		/**
		 * @param boolean $is_alias
		 */
		public function setIsAlias($is_alias)
		{
			$this->is_alias = $is_alias;
		}

		/**
		 * @return int
		 */
		public function getParentUid()
		{
			return $this->parent_uid;
		}

		/**
		 * @param int $parent_uid
		 */
		public function setParentUid($parent_uid)
		{
			$this->parent_uid = $parent_uid;
		}

		/**
		 * @return string
		 */
		public function getUrl()
		{
			return $this->url;
		}

		/**
		 * @param string $url
		 */
		public function setUrl($url)
		{
			$this->url = $url;
		}

		/**
		 * @return int
		 */
		public function getSorting()
		{
			return $this->sorting;
		}

		/**
		 * @param int $sorting
		 */
		public function setSorting($sorting)
		{
			$this->sorting = $sorting;
		}

		/**
		 * @return string
		 */
		public function getFlag()
		{
			return $this->flag;
		}

		/**
		 * @param string $flag
		 */
		public function setFlag($flag)
		{
			$this->flag = $flag;
		}

		/**
		 * @return string
		 */
		public function getLocale()
		{
			return $this->locale;
		}

		/**
		 * @param string $locale
		 */
		public function setLocale($locale)
		{
			$this->locale = $locale;
		}

		/**
		 * @return int
		 */
		public function getDomainUid()
		{
			return $this->domain_uid;
		}

		/**
		 * @param int $domain_uid
		 */
		public function setDomainUid($domain_uid)
		{
			$this->domain_uid = $domain_uid;
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
		 * @return Core\System\Domain\Model\Domain
		 * @throws \Core\Tools\Exception
		 */
		public function getDomain() {
			if ($this->domain == null) {
				$this->domain = Utility::createInstance("Core\\System\\Domain\\Collection\\DomainCollection")->findByUid($this->domain_uid);
			}
			return $this->domain;
		}

	}

}
