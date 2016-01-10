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
	use Doctrine\ORM\Mapping AS ORM;

	/**
	 * @Table(name="sys_pages")
	 * @Entity(repositoryClass="Continut\Core\System\Domain\Collection\PageCollection")
	 */
	class Page extends BaseModel {

		/**
		 * @var string Page title
		 * @Column(type="string")
		 */
		protected $title = "Unnamed page";

		/**
		 * @var \Continut\Core\System\Domain\Model\DomainUrl
		 *
		 * @Column(type="integer", name="parent_id")
		 * @OneToOne(targetEntity="Page")
		 * @JoinColumn(name="parent_id", referencedColumnName="id")
		 */
		protected $parent;

		/**
		 * @var string iso3 code of this page's language
		 *
		 * @Column(name="language_iso3", type="string", length=3, nullable=false)
		 */
		protected $languageIso3 = "";

		/**
		 * @var bool Is our Page visible in the Frontend?
		 *
		 * @Column(name="is_visible", type="boolean", nullable=true)
		 */
		protected $isVisible = TRUE;

		/**
		 * @var bool Is our page shown in frontend menus?
		 *
		 * @Column(name="is_in_menu", type="boolean", nullable=true)
		 */
		protected $isInMenu = TRUE;

		/**
		 * @var bool Has our Page been deleted?
		 *
		 * @Column(name="is_deleted", type="boolean", nullable=true)
		 */
		protected $isDeleted = FALSE;

		/**
		 * @var int The id of the domain url this page belongs to
		 *
		 * @Column(type="integer", name="domain_url_id")
		 * @OneToOne(targetEntity="\Continut\Core\System\Domain\Model\DomainUrl")
		 * @JoinColumn(name="domain_url_id", referencedColumnName="id")
		 */
		protected $domainUrl;

		/**
		 * @var string Layout for this page
		 *
		 * @Column(type="string")
		 */
		protected $layout;

		/**
		 * @var bool Are templates inherited recursively or not?
		 *
		 * @Column(name="layout_recursive", type="boolean", nullable=true)
		 */
		protected $layoutRecursive;

		/**
		 * @var string Frontend cached layout path for this page
		 *
		 * @Column(name="frontend_layout", type="string", length=255, nullable=true)
		 */
		protected $frontendLayout;

		/**
		 * @var string Backend cached layout path for this page
		 *
		 * @Column(name="backend_layout", type="string", length=255, nullable=true)
		 */
		protected $backendLayout;

		/**
		 * @var string Cached path used for breadcrumb (List of comma separated values of parent ids)
		 *
		 * @Column(name="cached_path", type="string", length=255, nullable=true)
		 */
		protected $cachedPath;

		/**
		 * @var string Page slug
		 *
		 * @Column(name="slug", type="string", length=255, nullable=false)
		 */
		protected $slug;

		/**
		 * @var int Sorting order
		 *
		 * @Column(name="sorting", type="integer", nullable=true)
		 */
		protected $sorting;

		/**
		 * @var string Meta keywords for the page
		 *
		 * @Column(name="meta_keywords", type="string", length=255, nullable=true)
		 */
		protected $metaKeywords;

		/**
		 * @var string Meta description for the page
		 *
		 * @Column(name="meta_description", type="text", length=65535, nullable=true)
		 */
		protected $metaDescription;

		/**
		 * @var int Original page record, used for translated pages. It is the original page from which this one was translated
		 *
		 * @OneToOne(targetEntity="Page")
		 * @JoinColumn(name="original_id", referencedColumnName="id")
		 */
		protected $original;

		/**
		 * @var \DateTime Start date from when the page should be visible in the frontend
		 *
		 * @Column(name="start_date", type="datetime", nullable=true)
		 */
		protected $startDate;

		/**
		 * @var \DateTime End date until the page will be visible in the frontend
		 *
		 * @Column(name="end_date", type="datetime", nullable=true)
		 */
		protected $endDate;

		/**
		 * @return boolean
		 */
		public function getIsInMenu()
		{
			return $this->isInMenu;
		}

		/**
		 * @param boolean $isInMenu
		 *
		 * @return Page
		 */
		public function setIsInMenu($isInMenu)
		{
			$this->isInMenu = $isInMenu;

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
			return $this->metaKeywords;
		}

		/**
		 * @param string $metaKeywords
		 */
		public function setMetaKeywords($metaKeywords)
		{
			$this->metaKeywords = $metaKeywords;
		}

		/**
		 * @return string
		 */
		public function getMetaDescription()
		{
			return $this->metaDescription;
		}

		/**
		 * @param string $metaDescription
		 */
		public function setMetaDescription($metaDescription)
		{
			$this->metaDescription = $metaDescription;
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
		 * @return Page
		 */
		public function setSorting($sorting)
		{
			$this->sorting = $sorting;

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
		 * @return Page
		 */
		public function setIsVisible($isVisible)
		{
			$this->isVisible = $isVisible;

			return $this;
		}

		/**
		 * @return boolean
		 */
		public function getIsDeleted()
		{
			return $this->isDeleted;
		}

		/**
		 * @param boolean $isDeleted
		 *
		 * @return Page
		 */
		public function setIsDeleted($isDeleted)
		{
			$this->isDeleted = $isDeleted;

			return $this;
		}

		/**
		 * @return \Continut\Core\System\Domain\Model\DomainUrl
		 */
		public function getDomainUrl()
		{
			return $this->domainUrl;
		}

		/**
		 * @param \Continut\Core\System\Domain\Model\DomainUrl $domainUrl
		 *
		 * @return Page
		 */
		public function setDomainUrl($domainUrl)
		{
			$this->domainUrl = $domainUrl;

			return $this;
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
		 * @return Page
		 */
		public function setTitle($title) {
			$this->title = $title;

			return $this;
		}

		/**
		 * @return string
		 */
		public function getLanguageIso3() {
			return $this->languageIso3;
		}

		/**
		 * @param string $languageIso3
		 *
		 * @return Page
		 */
		public function setLanguageIso3($languageIso3) {
			$this->languageIso3 = $languageIso3;

			return $this;
		}

		/**
		 * @param Page $parent
		 *
		 * @return Page
		 */
		public function setParent($parent) {
			$this->parent = $parent;

			return $this;
		}

		/**
		 * @return Page
		 */
		public function getParent() {
			return $this->parent;
		}

		/**
		 * Merges different values from the original page to the translated one
		 * Settings like the frontend or backend layout to use are only specified on the original page, and thus
		 * need to be re-added to the translated one too
		 *
		 * @return Page
		 */
		public function mergeOriginal() {
			if ($this->getOriginal()) {
				$originalPage = $this->getOriginal();
				$this->setBackendLayout($originalPage->getBackendLayout());
				$this->setFrontendLayout($originalPage->getFrontendLayout());
			}

			return $this;
		}

		/**
		 * @return Page
		 */
		public function getOriginal() {
			return $this->original;
		}

		/**
		 * @param Page $original
		 *
		 * @return Page
		 */
		public function setOriginal($original)
		{
			$this->original = $original;

			return $this;
		}

		/**
		 * Layout to be used in the frontend
		 * @return string
		 */
		public function getFrontendLayout() {
			return $this->frontendLayout;
		}

		/**
		 * Sets the layout to be used in the frontend
		 * @param string $frontendLayout
		 *
		 * @return Page
		 */
		public function setFrontendLayout($frontendLayout) {
			$this->frontendLayout = $frontendLayout;

			return $this;
		}

		/**
		 * Layout to be used in the Backend preview
		 *
		 * @return string
		 */
		public function getBackendLayout() {
			return $this->backendLayout;
		}

		/**
		 * @param string $backendLayout
		 *
		 * @return Page
		 */
		public function setBackendLayout($backendLayout) {
			$this->backendLayout = $backendLayout;

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
		 *
		 * @return Page
		 */
		public function setLayout($layout)
		{
			$this->layout = $layout;

			return $this;
		}

		/**
		 * Returns comma separated list of breadcrumb page ids
		 *
		 * @return string
		 */
		public function getCachedPath() {
			return $this->cachedPath;
		}

		/**
		 * @param string $cachedPath
		 *
		 * @return Page
		 */
		public function setCachedPath($cachedPath)
		{
			$this->cachedPath = $cachedPath;

			return $this;
		}

		/**
		 * @return boolean
		 */
		public function getLayoutRecursive()
		{
			return $this->layoutRecursive;
		}

		/**
		 * @param boolean $layoutRecursive
		 *
		 * @return Page
		 */
		public function setLayoutRecursive($layoutRecursive)
		{
			$this->layoutRecursive = $layoutRecursive;

			return $this;
		}

		/**
		 * @return \DateTime
		 */
		public function getStartDate()
		{
			return $this->startDate;
		}

		/**
		 * @param \DateTime $startDate
		 *
		 * @return Page
		 */
		public function setStartDate($startDate)
		{
			$this->startDate = $startDate;

			return $this;
		}

		/**
		 * @return \DateTime
		 */
		public function getEndDate()
		{
			return $this->endDate;
		}

		/**
		 * @param \DateTime $endDate
		 *
		 * @return Page
		 */
		public function setEndDate($endDate)
		{
			$this->endDate = $endDate;

			return $this;
		}
	}
}