<?php
/**
 * This file is part of the Conţinut CMS project.
 * Distributed under the GNU General Public License.
 * For more details, consult the LICENSE.txt file supplied with the project

 * Author: Radu Mogoş <radu.mogos@pixelplant.ch>
 * Date: 05.04.2015 @ 12:40
 * Project: Conţinut CMS
 */

namespace Continut\Core\System\Domain\Model {

	use Continut\Core\Mvc\Model\BaseModel;
	use Continut\Core\Utility;

	class Page extends BaseModel {

		/**
		 * @var string Page title
		 */
		protected $title = "Unnamed page";

		/**
		 * @var \Core\System\Domain\Model\Page
		 */
		protected $parent;

		/**
		 * @var int Parent page id
		 */
		protected $parent_id;

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
		 * @var bool Has our Page been deleted?
		 */
		protected $is_deleted = FALSE;

		/**
		 * @var int The id of the domain url this page belongs to
		 */
		protected $domain_url_id = 0;

		/**
		 * @var string Layout for this page
		 */
		protected $layout;

		/**
		 * @var bool Are templates inherited recursively or not?
		 */
		protected $layout_recursive;

		/**
		 * @var string Frontend cached layout path for this page
		 */
		protected $frontend_layout;

		/**
		 * @var string Backend cached layout path for this page
		 */
		protected $backend_layout;

		/**
		 * @var string Cached path used for breadcrumb (List of comma separated values of parent ids)
		 */
		protected $cached_path;

		/**
		 * @var string Page slug
		 */
		protected $slug;

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
		 * @var int
		 */
		protected $original_id;

		/**
		 * @var \Core\System\Domain\Model\Page Original page, if this is a translated one
		 */
		protected $original;

		/**
		 * @var \DateTime
		 */
		protected $start_date;

		/**
		 * @var \DateTime
		 */
		protected $end_date;

		/**
		 * Simple datamapper used for the database
		 * @return array
		 */
		public function dataMapper() {
			return [
				"parent_id"       => $this->parent_id,
				"title"            => $this->title,
				"slug"             => $this->slug,
				"language_iso3"    => $this->language_iso3,
				"cached_path"      => $this->cached_path,
				"domain_url_id"   => $this->domain_url_id,
				"is_deleted"       => $this->is_deleted,
				"is_in_menu"       => $this->is_in_menu,
				"is_visible"       => $this->is_visible,
				"layout"           => $this->layout,
				"layout_recursive" => $this->layout_recursive,
				"frontend_layout"  => $this->frontend_layout,
				"backend_layout"   => $this->backend_layout,
				"original_id"     => $this->original_id,
				"sorting"          => $this->sorting,
				"meta_keywords"    => $this->meta_keywords,
				"meta_description" => $this->meta_description,
				"start_date"       => $this->start_date,
				"end_date"         => $this->end_date
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
		public function getDomainUrlId()
		{
			return $this->domain_url_id;
		}

		/**
		 * @param int $domain_url_id
		 */
		public function setDomainUrlId($domain_url_id)
		{
			$this->domain_url_id = $domain_url_id;
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

		/**
		 * @return string
		 */
		public function getLanguageIso3() {
			return $this->language_iso3;
		}

		/**
		 * @param string $language_iso3
		 *
		 * @return mixed
		 */
		public function setLanguageIso3($language_iso3) {
			return $this->language_iso3 = $language_iso3;
		}

		/**
		 * @param $parentId
		 *
		 * @return $this
		 */
		public function setParentId($parentId) {
			$this->parent_id = $parentId;

			return $this;
		}

		/**
		 * @return int
		 */
		public function getParentId() {
			return $this->parent_id;
		}

		/**
		 * Get parent PageModel
		 *
		 * @return mixed
		 * @throws \Core\Tools\Exception
		 */
		public function getParent() {
			if ($this->parent_id) {
				if (empty($this->parent)) {
					$this->parent = Utility::createInstance("\\Core\\System\\Domain\\Collection\\PageCollection")
						->findById($this->getParentId());
				}
			}

			return $this->parent;
		}

		/**
		 * Merges different values from the original page to the translated one
		 * Settings like the frontend or backend layout to use are only specified on the original page, and thus
		 * need to be re-added to the translated one too
		 *
		 * @return $this
		 */
		public function mergeOriginal() {
			if ($this->original_id > 0) {
				$originalPage = $this->getOriginal();
				$this->setBackendLayout($originalPage->getBackendLayout());
				$this->setFrontendLayout($originalPage->getFrontendLayout());
			}

			return $this;
		}

		/**
		 * @return Page
		 * @throws \Core\Tools\Exception
		 */
		public function getOriginal() {
			if ($this->original_id) {
				if (empty($this->original)) {
					$this->original = Utility::createInstance('Continut\Core\System\Domain\Collection\PageCollection')
						->findById($this->getOriginalId());
				}
			}

			return $this->original;
		}

		/**
		 * @return int
		 */
		public function getOriginalId()
		{
			return $this->original_id;
		}

		/**
		 * @param int $original_id
		 *
		 * @return $this
		 */
		public function setOriginalId($original_id)
		{
			$this->original_id = $original_id;

			return $this;
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
		 * Sets the layout to be used in the frontend
		 * @param $frontend_layout
		 *
		 * @return $this
		 */
		public function setFrontendLayout($frontend_layout) {
			$this->frontend_layout = $frontend_layout;

			return $this;
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
		 * @param string $backend_layout
		 *
		 * @return $this
		 */
		public function setBackendLayout($backend_layout) {
			$this->backend_layout = $backend_layout;

			return $this;
		}

		/**
		 * @return string
		 */
		public function getLayout()
		{
			return $this->layout;
		}

		/**
		 * @param string $layout
		 */
		public function setLayout($layout)
		{
			$this->layout = $layout;
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

		/**
		 * @return boolean
		 */
		public function getLayoutRecursive()
		{
			return $this->layout_recursive;
		}

		/**
		 * @param boolean $layout_recursive
		 */
		public function setLayoutRecursive($layout_recursive)
		{
			$this->layout_recursive = $layout_recursive;
		}

		/**
		 * @return \DateTime
		 */
		public function getStartDate()
		{
			return $this->start_date;
		}

		/**
		 * @param \DateTime $start_date
		 */
		public function setStartDate($start_date)
		{
			$this->start_date = $start_date;
		}

		/**
		 * @return \DateTime
		 */
		public function getEndDate()
		{
			return $this->end_date;
		}

		/**
		 * @param \DateTime $end_date
		 */
		public function setEndDate($end_date)
		{
			$this->end_date = $end_date;
		}
	}
}