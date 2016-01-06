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
	use Continut\Core\Utility;

	class Domain extends BaseModel {

		/**
		 * @var string
		 */
		protected $title;

		/**
		 * @var boolean
		 */
		protected $is_visible;

		/**
		 * @var int
		 */
		protected $sorting;

		/**
		 * @var array
		 */
		protected $domain_urls;

		/**
		 * Simple datamapper used for the database
		 * @return array
		 */
		public function dataMapper() {
			return [
				"title"           => $this->title,
				"is_visible"      => $this->is_visible,
				"sorting"         => $this->sorting
 			];
		}

		/**
		 * @return string
		 */
		public function getTitle() {
			return $this->title;
		}

		/**
		 * @param $title
		 */
		public function setTitle($title) {
			$this->title = $title;
		}

		/**
		 * @return boolean
		 */
		public function isIsVisible()
		{
			return $this->is_visible;
		}

		/**
		 * @param boolean $is_visible
		 */
		public function setIsVisible($is_visible)
		{
			$this->is_visible = $is_visible;
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
		 * @return array
		 * @throws \Continut\Core\Tools\Exception
		 */
		public function getDomainUrls() {
			if ($this->domain_urls == null) {
				$this->domain_urls = Utility::createInstance("Continut\\Core\\System\\Domain\\Collection\\DomainUrlCollection")->findByDomain_uid($this->uid)->getAll();
			}
			return $this->domain_urls;
		}
	}

}
