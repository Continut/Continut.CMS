<?php
/**
 * This file is part of the Conţinut CMS project.
 * Distributed under the GNU General Public License.
 * For more details, consult the LICENSE.txt file supplied with the project
 * Author: Radu Mogoş <radu.mogos@pixelplant.ch>
 * Date: 04.04.2015 @ 13:02
 * Project: Conţinut CMS
 */

namespace Continut\Core\System\Domain\Collection;

use Continut\Core\Mvc\Model\BaseCollection;

class ContentCollection extends BaseCollection
{

    /**
     * Set tablename and element class
     */
    public function __construct()
    {
        $this->tablename = 'sys_content';
        $this->elementClass = 'Continut\Core\System\Domain\Model\Content';
    }

    /**
     * Build a json tree of pages, specifically useful for JSON consuming javascript plugins
     *
     * @return array
     */
    public function buildJsonTree()
    {
        $children = [];

        // add a root child node, that selects the page
        $rootChild = new \stdClass();
        $rootChild->id = '9999';
        $rootChild->parentId = '0';
        $rootChild->label = 'Root node';
        $rootChild->text = 'Root';
        $rootChild->icon = 'fa fa-sitemap';
        $rootChild->status = 'normal';

        $children[0][] = $rootChild;

        foreach ($this->getAll() as $item) {
            $data = new \stdClass();
            $data->id = $item->getId();
            $data->parentId = $item->getParentId();
            $data->label = $item->getTitle() . " [id: $data->id]";
            $data->text = $item->getTitle();
            $data->status = "normal";
            //$data->type = $item->getType();
            switch ($item->getType()) {
                case 'content':
                    $data->icon = 'fa fa-file-text';
                    break;
                case 'plugin':
                    $data->icon = 'fa fa-list-alt';
                    break;
                case 'container':
                    $data->icon = 'fa fa-columns';
                    break;
                default:
                    $data->icon = 'fa fa-file-text';
            }
            if (!$item->getIsVisible()) {
                $data->status = "hidden-frontend";
            }
            $children[$data->parentId][] = $data;
        }

        foreach ($children as $child) {
            foreach ($child as $data) {
                if (isset($children[$data->id])) {
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
     * Returns the entire tree for a leaf with a certain id
     *
     * @param int $id
     *
     * @return mixed
     */
    public function findChildrenForId($id)
    {
        $tree = $this->buildTree();

        return $this->browseChildren($tree, $id);
    }

    /**
     * Build a tree of content elements from this collection
     *
     * @return null
     */
    public function buildTree()
    {
        // Build content tree
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

        $tree = NULL;
        if (isset($children[0])) {
            $tree = $children[0];
        }

        return $tree;
    }

    /**
     * Called recursively by findChildrenForId
     *
     * @param $elements
     * @param $id
     *
     * @return mixed
     */
    protected function browseChildren($elements, $id)
    {
        if ($elements) {
            foreach ($elements as $child) {
                if ($child->getId() == $id) {
                    return $child;
                } else {
                    $this->browseChildren($child->children, $id);
                }
            }
        }
        return null;
    }
}

