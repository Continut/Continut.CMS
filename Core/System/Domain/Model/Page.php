<?php
/**
 * This file is part of the Conţinut CMS project.
 * Distributed under the GNU General Public License.
 * For more details, consult the LICENSE.txt file supplied with the project

 * Author: Radu Mogoş <radu.mogos@pixelplant.ch>
 * Date: 05.04.2015 @ 12:40
 * Project: Conţinut CMS
 */

namespace Core\System\Domain\Model {

	use Core\Mvc\Model\BaseModel;
	use Core\Utility;

	class Page extends BaseModel {

		/**
		 * @var string Page title
		 */
		protected $title = "Unnamed page";

		protected $parent;

		/**
		 * @var int Parent page id
		 */
		protected $parent_uid;

		/**
		 * @var string iso3 code of this page's language
		 */
		protected $language_iso3 = "";

		/**
		 * @var bool Is our Page visible in the Frontend?
		 */
		protected $is_visible = TRUE;

		/**
		 * @var bool Is our page shown in frontend menus?
		 */
		protected $is_in_menu = TRUE;

		/**
		 * @var boor Has our Page been deleted?
		 */
		protected $is_deleted = FALSE;

		/**
		 * @var int The id of the domain this page belongs to
		 */
		protected $domain_uid = 0;

		/**
		 * @var string Layout used by this Page
		 */
		protected $frontend_layout;

		/**
		 * @var string Cached path used for breadcrumb (List of comma separated values of parent uids)
		 */
		protected $cached_path;

		/**
		 * @var string Page slug
		 */
		protected $slug;

		/**
		 * @var string Backend layout
		 */
		protected $backend_layout;

		/**
		 * @var int Sorting order
		 */
		protected $sorting;

		/**
		 * @var string
		 */
		protected $meta_keywords;

		/**
		 * @var string
		 */
		protected $meta_description;

		/**
		 * Simple datamapper used for the database
		 * @return array
		 */
		public function dataMapper() {
			return [
				"parent_uid"      => $this->parent_uid,
				"title"           => $this->title,
				"language_iso3"   => $this->language_iso3,
				"cached_path"     => $this->cached_path,
				"domain_uid"      => $this->domain_uid,
				"is_deleted"      => $this->is_deleted,
				"is_in_menu"      => $this->is_in_menu,
				"is_visible"      => $this->is_visible,
				"frontend_layout" => $this->frontend_layout,
				"backend_layout"  => $this->backend_layout,
				"sorting"         => $this->sorting
			];
		}

		/**
		 * @return boolean
		 */
		public function getIsInMenu()
		{
			return $this->is_in_menu;
		}

		/**
		 * @param boolean $is_in_menu
		 *
		 * @return $this
		 */
		public function setIsInMenu($is_in_menu)
		{
			$this->is_in_menu = $is_in_menu;

			return $this;
		}

		/**
		 * @return string
		 */
		public function getSlug()
		{
			return $this->slug;
		}

		/**
		 * @param string $slug
		 */
		public function setSlug($slug)
		{
			$this->slug = $slug;
		}

		/**
		 * @return string
		 */
		public function getMetaKeywords()
		{
			return $this->meta_keywords;
		}

		/**
		 * @param string $meta_keywords
		 */
		public function setMetaKeywords($meta_keywords)
		{
			$this->meta_keywords = $meta_keywords;
		}

		/**
		 * @return string
		 */
		public function getMetaDescription()
		{
			return $this->meta_description;
		}

		/**
		 * @param string $meta_description
		 */
		public function setMetaDescription($meta_description)
		{
			$this->meta_description = $meta_description;
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
		 * @return boolean
		 */
		public function getIsVisible()
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
		 * @return boor
		 */
		public function getIsDeleted()
		{
			return $this->is_deleted;
		}

		/**
		 * @param boor $is_deleted
		 */
		public function setIsDeleted($is_deleted)
		{
			$this->is_deleted = $is_deleted;
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
		 * Return page title
		 *
		 * @return string
		 */
		public function getTitle() {
			return $this->title;
		}

		/**
		 * Set page title
		 *
		 * @param $title
		 *
		 * @return $this
		 */
		public function setTitle($title) {
			$this->title = $title;

			return $this;
		}

		public function getLanguageIso3() {
			return $this->language_iso3;
		}

		/**
		 * @param $parentUid
		 *
		 * @return $this
		 */
		public function setParentUid($parentUid) {
			$this->parent_uid = $parentUid;

			return $this;
		}

		/**
		 * @return int
		 */
		public function getParentUid() {
			return $this->parent_uid;
		}

		/**
		 * Get parent PageModel
		 *
		 * @return mixed
		 * @throws \Core\Tools\Exception
		 */
		public function getParent() {
			if ($this->parent_uid) {
				if (empty($this->parent)) {
					$this->parent = Utility::createInstance("\\Core\\System\\Domain\\Collection\\PageCollection")->
					where("uid = :parent_uid", $this->getParentUid())
						->getFirst();
				}
			}

			return $this->parent;
		}

		/**
		 * Set this page's parent
		 *
		 * @param \Core\System\Domain\Model\Page $parent
		 *
		 * @return $this
		 */
		public function setParent($parent) {
			$this->parent = $parent;

			return $this;
		}

		/**
		 * Layout to be used in the frontend
		 * @return string
		 */
		public function getFrontendLayout() {
			return $this->frontend_layout;
		}

		/**
		 * Layout to be used in the Backend preview
		 *
		 * @return string
		 */
		public function getBackendLayout() {
			return $this->backend_layout;
		}

		/**
		 * Returns comma separated list of breadcrumb page ids
		 *
		 * @return string
		 */
		public function getCachedPath() {
			return $this->cached_path;
		}

		/**
		 * @param string $cached_path
		 */
		public function setCachedPath($cached_path)
		{
			$this->cached_path = $cached_path;
		}
	}
}