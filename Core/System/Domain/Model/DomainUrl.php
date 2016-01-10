<?php
/**
 * This file is part of the Conţinut CMS project.
 * Distributed under the GNU General Public License.
 * For more details, consult the LICENSE.txt file supplied with the project
 * Author: Radu Mogoş <radu.mogos@pixelplant.ch>
 * Date: 08.08.2015 @ 14:58
 * Project: Conţinut CMS
 */
namespace Continut\Core\System\Domain\Model {

	use Continut\Core\Mvc\Model\BaseModel;

	/**
	 * @Table(name="sys_domain_urls")
	 * @Entity(repositoryClass="Continut\Core\System\Domain\Collection\DomainUrlCollection")
	 */
	class DomainUrl extends BaseModel {

		/**
		 * @var boolean
		 *
		 * @Column(name="is_alias", type="boolean", nullable=false)
		 */
		protected $isAlias = 0;

		/**
		 * @var DomainUrl
		 *
		 * @OneToOne(targetEntity="DomainUrl")
		 * @JoinColumn(name="parent_id", referencedColumnName="id")
		 */
		protected $parent;

		/**
		 * @var Domain
		 *
		 * @ManyToOne(targetEntity="Continut\Core\System\Domain\Model\Domain", inversedBy="domainUrls")
		 * @JoinColumn(name="domain_id", referencedColumnName="id")
		 */
		protected $domain;

		/**
		 * @var string
		 *
		 * @Column(type="string")
		 */
		protected $url;

		/**
		 * @var int
		 *
		 * @Column(name="sorting", type="integer", nullable=false)
		 */
		protected $sorting;

		/**
		 * @var string ISO2 code used for the flag
		 *
		 * @Column(name="flag", type="string", length=2)
		 */
		protected $flag;

		/**
		 * @var string Locale used by this domain url
		 *
		 * @Column(name="locale", type="string", length=20)
		 */
		protected $locale;

		/**
		 * @var string
		 *
		 * @Column(name="title", type="string", length=255, nullable=true)
		 */
		protected $title;

		/**
		 * @return boolean
		 */
		public function getIsAlias()
		{
			return $this->isAlias;
		}

		/**
		 * @param boolean $isAlias
		 *
		 * @return DomainUrl
		 */
		public function setIsAlias($isAlias)
		{
			$this->isAlias = $isAlias;

			return $this;
		}

		/**
		 * @return DomainUrl
		 */
		public function getParent()
		{
			return $this->parent;
		}

		/**
		 * @param DomainUrl $parent
		 *
		 * @return DomainUrl
		 */
		public function setParent($parent)
		{
			$this->parent = $parent;

			return $this;
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
		 *
		 * @return DomainUrl
		 */
		public function setUrl($url)
		{
			$this->url = $url;

			return $this;
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
		 *
		 * @return DomainUrl
		 */
		public function setSorting($sorting)
		{
			$this->sorting = $sorting;

			return $this;
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
		 *
		 * @return DomainUrl
		 */
		public function setFlag($flag)
		{
			$this->flag = $flag;

			return $this;
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
		 *
		 * @return DomainUrl
		 */
		public function setLocale($locale)
		{
			$this->locale = $locale;

			return $this;
		}

		/**
		 * @return Domain
		 */
		public function getDomain()
		{
			return $this->domain;
		}

		/**
		 * @param Domain $domain
		 *
		 * @return DomainUrl
		 */
		public function setDomain($domain)
		{
			$this->domain = $domain;

			return $this;
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
		 *
		 * @return DomainUrl
		 */
		public function setTitle($title)
		{
			$this->title = $title;

			return $this;
		}

	}

}
