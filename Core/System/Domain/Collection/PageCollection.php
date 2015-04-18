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
		 *
		 * @return array
		 */
		public function buildTree() {
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
			if (isset($children[0])) {
				$tree = $children[0];
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
				$data->label    = $item->getTitle();
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
			if (isset($children[0])) {
				$tree = $children[0];
			}

			return $tree;
		}
	}

}
