<?php
/**
 * This file is part of the Conţinut CMS project.
 * Distributed under the GNU General Public License.
 * For more details, consult the LICENSE.txt file supplied with the project

 * Author: Radu Mogoş <radu.mogos@pixelplant.ch>
 * Date: 04.04.2015 @ 13:02
 * Project: Conţinut CMS
 */
namespace Core\System\Domain\Collection {

	use Core\Mvc\Model\BaseCollection;

	class ContentCollection extends BaseCollection {

		/**
		 * Set tablename and element class
		 */
		public function __construct() {
			$this->_tablename = "sys_content";
			$this->_elementClass = "\\Core\\System\\Domain\\Model\\Content";
		}

		/**
		 * Build a tree of content elements from this collection
		 *
		 * @return null
		 */
		public function buildTree() {
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
		 * Returns the entire tree for a leaf with a certain id
		 *
		 * @param int $id
		 *
		 * @return mixed
		 */
		public function findChildrenForId($id) {
			$tree = $this->buildTree();

			return $this->browseChildren($tree, $id);
		}

		/**
		 * Called recursively by findChildrenForId
		 *
		 * @param $elements
		 * @param $id
		 *
		 * @return mixed
		 */
		protected function browseChildren($elements, $id) {
			if ($elements) {
				foreach ($elements as $child) {
					if ($child->getId() == $id) {
						return $child;
					} else {
						$this->browseChildren($child->children, $id);
					}
				}
			}
		}
	}

}
