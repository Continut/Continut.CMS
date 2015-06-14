<?php
/**
 * This file is part of the Conţinut CMS project.
 * Distributed under the GNU General Public License.
 * For more details, consult the LICENSE.txt file supplied with the project

 * Author: Radu Mogoş <radu.mogos@pixelplant.ch>
 * Date: 04.04.2015 @ 12:39
 * Project: Conţinut CMS
 */
namespace Core\System\Domain\Collection {

	use Core\Mvc\Model\BaseCollection;

	class PageCollection extends BaseCollection {

		/**
		 * Set tablename and each element's class
		 */
		public function __construct() {
			$this->_tablename = "sys_pages";
			$this->_elementClass = "\\Core\\System\\Domain\\Model\\Page";
		}

		/**
		 * Build a tree out of the returned pages
		 * Optionally return only the children for a certain child uid
		 *
		 * @return array
		 */
		public function buildTree($childUid = 0) {
			$children = [];
			foreach ($this->getAll() as $item) {
				$children[$item->getParentUid()][] = $item;
			}

			foreach ($this->getAll() as $item) {
				if (isset($children[$item->getUid()])) {
					$item->children = $children[$item->getUid()];
				} else {
					$item->children = [];
				}
			}

			$tree = [];
			if (sizeof($children) > 0) {
				if ($childUid > 0) {
					$tree = $children[$childUid];
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
		public function buildJsonTree() {
			$children = [];

			foreach ($this->getAll() as $item) {
				$data           = new \stdClass();
				$data->id       = $item->getUid();
				$data->parentId = $item->getParentUid();
				$data->label    = $item->getTitle() . " [id: $data->id]";
				$data->type     = "file";
				$data->state    = "normal";
				if (!$item->getIsVisible()) {
					$data->state = "hidden-frontend";
					if (!$item->getIsInMenu()) {
						$data->state = "hidden-both";
					}
				} elseif (!$item->getIsInMenu()) {
					$data->state = "hidden-menu";
				}
				$children[$data->parentId][] = $data;
			}

			foreach ($children as $child) {
				foreach ($child as $data) {
					if (isset($children[ $data->id ])) {
						$data->type = "folder";
						$data->children = $children[ $data->id ];
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
		 * @param int $pageUid
		 *
		 * @return array
		 */
		public function cachedBreadcrumb($pageUid) {
			$cachedPath = [];

			$this->fetchParent($cachedPath, $pageUid);

			return $cachedPath;
		}

		/**
		 * @param $path
		 * @param $id
		 */
		protected function fetchParent(&$path, $id) {
			$page = $this->findByUid($id);
			$path[] = $id;
			if ($page->getParentUid() == 0) {
				return;
			} else {
				return $this->fetchParent($path, $page->getParentUid());
			}
		}

		/**
		 * Finds a page either by uid, if not zero, or by its slug
		 *
		 * @param int    $uid
		 * @param string $slug
		 *
		 * @return Core\System\Domain\Model\Page
		 */
		public function findWithUidOrSlug($uid, $slug) {
			if ($uid == 0) {
				return $this->where("slug LIKE :slug AND is_visible = 1 AND is_deleted = 0", ["slug" => $slug])->getFirst();
			} else {
				return $this->where("uid = :uid AND is_visible = 1 AND is_deleted = 0", ["uid" => $uid])->getFirst();
			}
		}
	}

}
