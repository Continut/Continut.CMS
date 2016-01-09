<?php
/**
 * This file is part of the Conţinut CMS project.
 * Distributed under the GNU General Public License.
 * For more details, consult the LICENSE.txt file supplied with the project

 * Author: Radu Mogoş <radu.mogos@pixelplant.ch>
 * Date: 04.04.2015 @ 13:02
 * Project: Conţinut CMS
 */
namespace Continut\Core\System\Domain\Collection {

	use Continut\Core\Mvc\Model\BaseRepository;

	/**
	 * Class ContentCollection
	 *
	 * @package Continut\Core\System\Domain\Collection
	 */
	class ContentCollection extends BaseRepository {

		/**
		 * Build a tree of content elements from this collection
		 *
		 * @param array $items
		 *
		 * @return null
		 */
		public function buildTree($items) {
			// Build content tree
			$children = [];

			foreach ($items as $item) {
				$children[$item->getParent()][] = $item;
			}

			foreach ($items as $item) {
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
		 * @param int $pageId
		 * @param int $elementId
		 *
		 * @return mixed
		 */
		public function findChildrenForId($pageId, $elementId) {
			$tree = $this->buildTree($this->findBy(["page" => $pageId]));

			return $this->browseChildren($tree, $elementId);
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
