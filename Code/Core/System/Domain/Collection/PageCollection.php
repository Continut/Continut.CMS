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

	class PageCollection extends BaseCollection{
		public function __construct() {
			$this->_tablename = "sys_pages";
			$this->_elementClass = "\\Core\\System\\Domain\\Model\\Page";
		}

		public function buildTree() {
			$children = [];
			foreach ($this->getAll() as $item) {
				$item->label = $item->getTitle();
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
	}

}
