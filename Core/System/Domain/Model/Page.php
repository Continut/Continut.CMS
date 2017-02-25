<?php
/**
 * This file is part of the Conţinut CMS project.
 * Distributed under the GNU General Public License.
 * For more details, consult the LICENSE.txt file supplied with the project
 * Author: Radu Mogoş <radu.mogos@pixelplant.ch>
 * Date: 05.04.2015 @ 12:40
 * Project: Conţinut CMS
 */

namespace Continut\Core\System\Domain\Model;

use Continut\Core\Mvc\Model\BaseModel;
use Continut\Core\Utility;

class Page extends BaseModel
{
    /**
     * @var string Page title
     */
    protected $title = "Unnamed page";

    /**
     * @var \Continut\Core\System\Domain\Model\Page
     */
    protected $parent;

    /**
     * @var int Parent page id
     */
    protected $parentId;

    /**
     * @var string iso3 code of this page's language
     */
    protected $languageIso3 = "";

    /**
     * @var bool Is our Page visible in the Frontend?
     */
    protected $isVisible = TRUE;

    /**
     * @var bool Is our page shown in frontend menus?
     */
    protected $isInMenu = TRUE;

    /**
     * @var bool Has our Page been deleted?
     */
    protected $isDeleted = FALSE;

    /**
     * @var int The id of the domain url this page belongs to
     */
    protected $domainUrlId = 0;

    /**
     * @var string Layout for this page
     */
    protected $layout;

    /**
     * @var bool Are templates inherited recursively or not?
     */
    protected $isLayoutRecursive;

    /**
     * @var string Frontend cached layout path for this page
     */
    protected $frontendLayout;

    /**
     * @var string Backend cached layout path for this page
     */
    protected $backendLayout;

    /**
     * @var string Cached path used for breadcrumb (List of comma separated values of parent ids)
     */
    protected $cachedPath;

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
    protected $metaKeywords;

    /**
     * @var string
     */
    protected $metaDescription;

    /**
     * @var int
     */
    protected $originalId;

    /**
     * @var \Continut\Core\System\Domain\Model\Page Original page, if this is a translated one
     */
    protected $original;

    /**
     * @var \DateTime
     */
    protected $startDate;

    /**
     * @var \DateTime
     */
    protected $endDate;

    /**
     * Simple datamapper used for the database
     *
     * @return array
     */
    public function dataMapper()
    {
        $fields = [
            'parent_id'           => $this->parentId,
            'title'               => $this->title,
            'slug'                => $this->slug,
            'language_iso3'       => $this->languageIso3,
            'cached_path'         => $this->cachedPath,
            'domain_url_id'       => $this->domainUrlId,
            'is_deleted'          => $this->isDeleted,
            'is_in_menu'          => $this->isInMenu,
            'is_visible'          => $this->isVisible,
            'layout'              => $this->layout,
            'is_layout_recursive' => $this->isLayoutRecursive,
            'frontend_layout'     => $this->frontendLayout,
            'backend_layout'      => $this->backendLayout,
            'original_id'         => $this->originalId,
            'sorting'             => $this->sorting,
            'meta_keywords'       => $this->metaKeywords,
            'meta_description'    => $this->metaDescription,
            'start_date'          => $this->startDate,
            'end_date'            => $this->endDate
        ];

        return array_merge($fields, parent::dataMapper());
    }

    /**
     * @return bool
     */
    public function getIsInMenu()
    {
        return $this->isInMenu;
    }

    /**
     * @param bool $isInMenu
     *
     * @return $this
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
     *
     * @return $this
     */
    public function setSlug($slug)
    {
        //$slug = Utility::generateSlug($slug);
        $this->slug = $slug;

        return $this;
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
     *
     * @return $this
     */
    public function setMetaKeywords($metaKeywords)
    {
        $this->metaKeywords = $metaKeywords;

        return $this;
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
     *
     * @return $this
     */
    public function setMetaDescription($metaDescription)
    {
        $this->metaDescription = $metaDescription;

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
     * @return $this
     */
    public function setSorting($sorting)
    {
        if ($sorting < 0) {
            $sorting = 0;
        }
        $this->sorting = $sorting;

        return $this;
    }

    /**
     * @return bool
     */
    public function getIsVisible()
    {
        return $this->isVisible;
    }

    /**
     * @param bool $isVisible
     *
     * @return $this
     */
    public function setIsVisible($isVisible)
    {
        $this->isVisible = $isVisible;

        return $this;
    }

    /**
     * @return bool
     */
    public function getIsDeleted()
    {
        return $this->isDeleted;
    }

    /**
     * @param bool $isDeleted
     *
     * @return $this
     */
    public function setIsDeleted($isDeleted)
    {
        $this->isDeleted = $isDeleted;

        return $this;
    }

    /**
     * @return int
     */
    public function getDomainUrlId()
    {
        return $this->domainUrlId;
    }

    /**
     * @param int $domainUrlId
     *
     * @return $this
     */
    public function setDomainUrlId($domainUrlId)
    {
        $this->domainUrlId = $domainUrlId;

        return $this;
    }

    /**
     * Return page title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set page title
     *
     * @param $title
     *
     * @return $this
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @return string
     */
    public function getLanguageIso3()
    {
        return $this->languageIso3;
    }

    /**
     * @param string $languageIso3
     *
     * @return $this
     */
    public function setLanguageIso3($languageIso3)
    {
        $this->languageIso3 = $languageIso3;

        return $this;
    }

    /**
     * Get parent PageModel
     *
     * @return mixed
     * @throws \Continut\Core\Tools\Exception
     */
    public function getParent()
    {
        if ($this->parentId) {
            if (empty($this->parent)) {
                $this->parent = Utility::createInstance('Continut\Core\System\Domain\Collection\PageCollection')
                    ->findById($this->getParentId());
            }
        }

        return $this->parent;
    }

    /**
     * Set this page's parent
     *
     * @param \Continut\Core\System\Domain\Model\Page $parent
     *
     * @return $this
     */
    public function setParent($parent)
    {
        $this->parent = $parent;

        return $this;
    }

    /**
     * @return int
     */
    public function getParentId()
    {
        return $this->parentId;
    }

    /**
     * @param $parentId
     *
     * @return $this
     */
    public function setParentId($parentId)
    {
        $this->parentId = $parentId;

        return $this;
    }

    /**
     * Merges different values from the original page to the translated one
     * Settings like the frontend or backend layout to use are only specified on the original page, and thus
     * need to be re-added to the translated one too
     *
     * @return $this
     */
    public function mergeOriginal()
    {
        if ($this->originalId > 0) {
            $originalPage = $this->getOriginal();
            $this->setBackendLayout($originalPage->getBackendLayout());
            $this->setFrontendLayout($originalPage->getFrontendLayout());
        }

        return $this;
    }

    /**
     * @return Page
     * @throws \Continut\Core\Tools\Exception
     */
    public function getOriginal()
    {
        if ($this->originalId) {
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
        return $this->originalId;
    }

    /**
     * @param int $originalId
     *
     * @return $this
     */
    public function setOriginalId($originalId)
    {
        $this->originalId = $originalId;

        return $this;
    }

    /**
     * Layout to be used in the Backend preview
     *
     * @return string
     */
    public function getBackendLayout()
    {
        return $this->backendLayout;
    }

    /**
     * @param string $backendLayout
     *
     * @return $this
     */
    public function setBackendLayout($backendLayout)
    {
        $this->backendLayout = $backendLayout;

        return $this;
    }

    /**
     * Layout to be used in the frontend
     *
     * @return string
     */
    public function getFrontendLayout()
    {
        return $this->frontendLayout;
    }

    /**
     * Sets the layout to be used in the frontend
     *
     * @param $frontendLayout
     *
     * @return $this
     */
    public function setFrontendLayout($frontendLayout)
    {
        $this->frontendLayout = $frontendLayout;

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
     * @return $this
     */
    public function setLayout($layout)
    {
        // set the layout identifier
        $this->layout = $layout;

        $extensionName = substr($layout, 0, strpos($layout, '.'));
        $settings = Utility::getExtensionSettings($extensionName);
        $layoutId = substr($layout, strlen($extensionName) + 1);

        // also set the BE and FE cached layout files
        if (isset($settings['ui']['layout'][$layoutId])) {
            $this->setBackendLayout($settings['ui']['layout'][$layoutId]['backendFile']);
            $this->setFrontendLayout($settings['ui']['layout'][$layoutId]['frontendFile']);
        }

        return $this;
    }

    /**
     * Layout is stored in the DB in the form ExtensionName.layoutName so this method extracts
     * the extension name from layout value (the first part before the '.' dot)
     *
     * @return string
     */
    public function getLayoutExtension() {
        if ($this->getLayout()) {
            return substr($this->getLayout(), 0, strpos($this->getLayout(), '.'));
        }
        return '';
    }

    /**
     * Returns comma separated list of breadcrumb page ids
     *
     * @return string
     */
    public function getCachedPath()
    {
        return $this->cachedPath;
    }

    /**
     * @param string $cachedPath
     *
     * @return $this
     */
    public function setCachedPath($cachedPath)
    {
        $this->cachedPath = $cachedPath;

        return $this;
    }

    /**
     * @return bool
     */
    public function getIsLayoutRecursive()
    {
        return $this->isLayoutRecursive;
    }

    /**
     * @param bool $isLayoutRecursive
     *
     * @return $this
     */
    public function setIsLayoutRecursive($isLayoutRecursive)
    {
        $this->isLayoutRecursive = $isLayoutRecursive;

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
     * @return $this
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
     * @return $this
     */
    public function setEndDate($endDate)
    {
        $this->endDate = $endDate;

        return $this;
    }

    /**
     * @param $pageId
     * @TODO Add method that automatically sets the sorting
     */
    public function moveBeforePageId($pageId) {

    }
}
