<?php
/**
 * This file is part of the Conţinut CMS project.
 * Distributed under the GNU General Public License.
 * For more details, consult the LICENSE.txt file supplied with the project
 
 * Author: Radu Mogoş <radu.mogos@pixelplant.ch>
 * Date: 07.04.2015 @ 22:46
 * Project: Conţinut CMS
 */
namespace Continut\Core\System\Domain\Model {

	use Continut\Core\Mvc\Model\BaseModel;
	use Doctrine\Common\Collections\ArrayCollection;

	/**
	 * Class Domain
	 *
	 * @package Continut\Core\System\Domain\Model
	 * @Table(name="sys_domains")
	 * @Entity(repositoryClass="Continut\Core\System\Domain\Collection\DomainCollection")
	 */
	class Domain extends BaseModel {

		/**
		 * @var string
		 *
		 * @Column(name="title", type="string")
		 */
		protected $title;

		/**
		 * @var boolean
		 *
		 * @Column(name="is_visible", type="boolean")
		 */
		protected $isVisible;

		/**
		 * @var int
		 *
		 * @Column(name="sorting", type="integer")
		 */
		protected $sorting;

		/**
		 * @var ArrayCollection
		 * @OneToMany(targetEntity="DomainUrl", mappedBy="domain")
		 */
		protected $domainUrls;

		public function __construct()
		{
			$this->domainUrls = new ArrayCollection();
		}

		/**
		 * @return string
		 */
		public function getTitle() {
			return $this->title;
		}

		/**
		 * @param $title
		 *
		 * @return Domain
		 */
		public function setTitle($title) {
			$this->title = $title;

			return $this;
		}

		/**
		 * @return boolean
		 */
		public function getIsVisible()
		{
			return $this->isVisible;
		}

		/**
		 * @param boolean $isVisible
		 *
		 * @return Domain
		 */
		public function setIsVisible($isVisible)
		{
			$this->isVisible = $isVisible;

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
		 * @return Domain
		 */
		public function setSorting($sorting)
		{
			$this->sorting = $sorting;

			return $this;
		}

		/**
		 *
		 */
		public function getDomainUrls() {
			return $this->domainUrls;
		}

		/**
		 * @param DomainUrl $domainUrl
		 */
		public function addDomainUrl($domainUrl) {
			$domainUrl->setDomain($this);
			$this->domainUrls[] = $domainUrl;
		}
	}

}
