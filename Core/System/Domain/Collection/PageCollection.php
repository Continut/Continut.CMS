<?php
/**
 * This file is part of the Conţinut CMS project.
 * Distributed under the GNU General Public License.
 * For more details, consult the LICENSE.txt file supplied with the project
 * Author: Radu Mogoş <radu.mogos@pixelplant.ch>
 * Date: 04.04.2015 @ 12:39
 * Project: Conţinut CMS
 */

namespace Continut\Core\System\Domain\Collection;

use Continut\Core\Mvc\Model\BaseCollection;
use Continut\Core\Utility;

class PageCollection extends BaseCollection
{

    /**
     * Set tablename and each element's class
     */
    public function __construct()
    {
        $this->tablename = 'sys_pages';
        $this->elementClass = 'Continut\Core\System\Domain\Model\Page';
    }

    protected function beforeSave()
    {
        parent::beforeSave();
        // before saving the page collection go through all the pages and generate
        // their breadcrumb path and store it in cached_path
        foreach ($this->getElements() as $element) {
            $cachedPath = $this->cachedBreadcrumb($element->getParentId());
            $element->setCachedPath(implode(',', $cachedPath));
        }
    }

    /**
     * Build a tree out of the returned pages
     * Optionally return only the children for a certain child id
     *
     * @param int $childId
     *
     * @return array
     */
    public function buildTree($childId = 0)
    {
        $children = [];
        foreach ($this->getAll() as $item) {
            $children[$item->getParentId()][] = $item;
        }

        foreach ($this->getAll() as $item) {
            if (isset($children[$item->getId()])) {
                $item->children = $children[$item->getId()];
            } else {
                $item->children = [];
            }
        }

        $tree = [];
        if (sizeof($children) > 0) {
            if ($childId > 0) {
                $tree = $children[$childId];
            } else {
                $tree = reset($children);
            }
        }

        return $tree;
    }

    /**
     * Build a json tree of pages, specifically useful for JSON consuming javascript plugins
     *
     * @return array
     */
    public function buildJsonTree()
    {
        $children = [];

        foreach ($this->getAll() as $item) {
            $data = new \stdClass();
            $data->id = $item->getId();
            $data->parentId = $item->getParentId();
            $data->label = $item->getTitle() . " [id: $data->id]";
            $data->text = $item->getTitle();
            //$data->type = "file";
            $data->icon = 'fa fa-file';
            $data->status = 'normal';
            if (!$item->getIsVisible()) {
                $data->status = 'hidden-frontend';
                $data->icon .= ' fa-disabled';
                if (!$item->getIsInMenu()) {
                    $data->status = 'hidden-both';
                    $data->icon = 'fa-disabled fa fa-eye-slash text-danger';
                }
            } elseif (!$item->getIsInMenu()) {
                $data->status = 'hidden-menu';
                $data->icon = 'fa fa-eye-slash text-danger';
            }
            $children[$data->parentId][] = $data;
        }

        foreach ($children as $child) {
            foreach ($child as $data) {
                if (isset($children[$data->id])) {
                    //$data->type = 'folder';
                    //$data->icon = 'fa fa-folder';
                    $data->children = $children[$data->id];
                } else {
                    $data->children = [];
                }
            }
        }

        $tree = [];
        if (sizeof($children) > 0) {
            $tree = reset($children);
        }

        return $tree;
    }

    /**
     * @param int $parentId
     *
     * @return array
     */
    public function cachedBreadcrumb($parentId)
    {
        $cachedPath = [];
        $cachedPath = $this->fetchParent($cachedPath, $parentId);

        return $cachedPath;
    }

    /**
     * @param $path
     * @param $id
     *
     * @return mixed
     */
    protected function fetchParent($path, $id)
    {
        if ($id > 0) {
            $page = $this->findById($id);
            $path[] = $id;
            if ($page->getParentId() == 0) {
                return $path;
            } else {
                return $this->fetchParent($path, $page->getParentId());
            }
        }
    }

    /**
     * Finds a page either by id, if not zero, or by its slug
     *
     * @param int    $id
     * @param string $slug
     *
     * @return \Continut\Core\System\Domain\Model\Page
     */
    public function findWithIdOrSlug($id, $slug)
    {
        $domainUrlId = Utility::getSite()->getDomainUrl()->getId();

        if (!(empty($slug))) {
            $page = $this->where(
                "slug LIKE :slug AND is_visible = 1 AND is_deleted = 0 AND domain_url_id = :domain_url_id",
                ["slug" => $slug, "domain_url_id" => $domainUrlId]
            )->getFirst();
        } else {
            // if an id is specified, get the page by id
            if ($id > 0) {
                $page = $this->where(
                    "id = :id AND is_visible = 1 AND is_deleted = 0 AND domain_url_id = :domain_url_id",
                    ["id" => $id, "domain_url_id" => $domainUrlId]
                )->getFirst();
            }
            // if the id is 0 (zero) it means we need to return the FIRST page defined for this domain (ordered by "sorting")
            else {
                $page = $this->where(
                    "is_visible = 1 AND is_deleted = 0 AND domain_url_id = :domain_url_id ORDER BY parent_id ASC, sorting ASC",
                    ["domain_url_id" => $domainUrlId]
                )->getFirst();
            }
        }
        // we just set the page id to the actual page that we find, in case it still has the value zero
        if ($page) {
            Utility::getRequest()->setArgument('id', (int)$page->getId());
        }

        return $page;
    }

    /**
     * Return all children pages for this page id
     *
     * @param int  $parentId
     * @param bool $includeDeleted
     * @param bool $includeHidden
     *
     * @return $this
     */
    public function findByParentId($parentId, $includeDeleted = false, $includeHidden = false)
    {
        $deletedString = '';
        if (!$includeDeleted) {
            $deletedString = 'AND is_deleted = 0';
        }
        $visibleString = '';
        if (!$includeHidden) {
            $visibleString = 'AND is_visible = 1';
        }
        return $this->where("is_in_menu = 1 $visibleString $deletedString AND domain_url_id = :domain_url_id AND parent_id = :parent_id ORDER BY parent_id ASC, sorting ASC",
            [
                'domain_url_id' => Utility::getSite()->getDomainUrl()->getId(),
                'parent_id'     => $parentId
            ]
            );
    }

    /**
     * Fetches all pages for a specified domain language that contain the searchTerm in their title
     *
     * @param int    $languageId
     * @param string $searchTerm
     *
     * @return $this
     */
    public function whereLanguageAndTitle($languageId, $searchTerm)
    {
        return $this->where(
            'domain_url_id = :domain_url_id AND is_deleted = 0 AND title LIKE :title ORDER BY parent_id ASC, sorting ASC',
            [
                'domain_url_id' => $languageId,
                'title'         => '%' . $searchTerm . '%'
            ]
        );
    }

    /**
     * Fetches all pages for a specified domain language
     *
     * @param int $languageId
     *
     * @return $this
     */
    public function whereLanguage($languageId) {
        return $this->where(
            'domain_url_id = :domain_url_id AND is_deleted=0 ORDER BY parent_id ASC, sorting ASC',
            [
                'domain_url_id' => $languageId
            ]
        );
    }
}
