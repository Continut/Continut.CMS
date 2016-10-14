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
    protected $layoutRecursive;

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
            "parent_id" => $this->parentId,
            "title" => $this->title,
            "slug" => $this->slug,
            "language_iso3" => $this->languageIso3,
            "cached_path" => $this->cachedPath,
            "domain_url_id" => $this->domainUrlId,
            "is_deleted" => $this->isDeleted,
            "is_in_menu" => $this->isInMenu,
            "is_visible" => $this->isVisible,
            "layout" => $this->layout,
            "layout_recursive" => $this->layoutRecursive,
            "frontend_layout" => $this->frontendLayout,
            "backend_layout" => $this->backendLayout,
            "original_id" => $this->originalId,
            "sorting" => $this->sorting,
            "meta_keywords" => $this->metaKeywords,
            "meta_description" => $this->metaDescription,
            "start_date" => $this->startDate,
            "end_date" => $this->endDate
        ];

        return array_merge($fields, parent::dataMapper());
    }

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
        return $this->isVisible;
    }

    /**
     * @param boolean $isVisible
     */
    public function setIsVisible($isVisible)
    {
        $this->isVisible = $isVisible;
    }

    /**
     * @return boor
     */
    public function getIsDeleted()
    {
        return $this->isDeleted;
    }

    /**
     * @param boor $isDeleted
     */
    public function setIsDeleted($isDeleted)
    {
        $this->isDeleted = $isDeleted;
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
     */
    public function setDomainUrlId($domainUrlId)
    {
        $this->domainUrlId = $domainUrlId;
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
     * @return mixed
     */
    public function setLanguageIso3($languageIso3)
    {
        return $this->languageIso3 = $languageIso3;
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
    public function getCachedPath()
    {
        return $this->cachedPath;
    }

    /**
     * @param string $cachedPath
     */
    public function setCachedPath($cachedPath)
    {
        $this->cachedPath = $cachedPath;
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
     */
    public function setLayoutRecursive($layoutRecursive)
    {
        $this->layoutRecursive = $layoutRecursive;
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
     */
    public function setStartDate($startDate)
    {
        $this->startDate = $startDate;
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
     */
    public function setEndDate($endDate)
    {
        $this->endDate = $endDate;
    }
}
