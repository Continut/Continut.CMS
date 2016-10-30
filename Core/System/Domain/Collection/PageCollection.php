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
        $this->tablename = "sys_pages";
        $this->elementClass = 'Continut\Core\System\Domain\Model\Page';
    }

    /**
     * Build a tree out of the returned pages
     * Optionally return only the children for a certain child id
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
                    $data->icon = 'fa fa-eye-slash text-danger';
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
     * @param int $pageId
     *
     * @return array
     */
    public function cachedBreadcrumb($pageId)
    {
        $cachedPath = [];

        $this->fetchParent($cachedPath, $pageId);

        return $cachedPath;
    }

    /**
     * @param $path
     * @param $id
     */
    protected function fetchParent(&$path, $id)
    {
        $page = $this->findById($id);
        $path[] = $id;
        if ($page->getParentId() == 0) {
            return;
        } else {
            return $this->fetchParent($path, $page->getParentId());
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
                    "is_visible = 1 AND is_deleted = 0 AND domain_url_id = :domain_url_id ORDER BY sorting ASC",
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
}
