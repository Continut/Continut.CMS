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
	use Continut\Core\Utility;

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

		/**
		 * Returns all the content elements found on a page
		 *
		 * @param Continut\Core\System\Domain\Model\Page $page
		 *
		 * @return array
		 */
		public function findWithPage($page, $isVisible = 1, $isDeleted = 0) {
			// are we in backend or frontend mode?
			$scope = Utility::getApplicationScope();

			$db = $this->getEntityManager()->createQueryBuilder();

			$db->select('p')
				->from($this->_entityName, 'p')
				->where('p.page = :page')
				->andWhere('p.isDeleted = :isDeleted')
				->setParameter('page', $page)
				->setParameter('isDeleted', $isDeleted)
				->addOrderBy("p.sorting", "ASC");
			if ($scope == Utility::SCOPE_FRONTEND) {
				$db->andWhere('p.isVisible = :isVisible')
					->setParameter('isVisible', $isVisible);
			}
			$rows = $db->getQuery()->getArrayResult();

			$elements = [];

			foreach ($rows as $row) {
				switch ($row["type"]) {
					case "plugin":    $element = Utility::createInstance('\Continut\Extensions\System\\' . $scope . '\Classes\Domain\Model\Content\\' . $scope . 'PluginContent'); break;
					case "container": $element = Utility::createInstance('\Continut\Extensions\System\\' . $scope . '\Classes\Domain\Model\Content\\' . $scope . 'ContainerContent'); break;
					case "reference": $element = Utility::createInstance('\Continut\Extensions\System\\' . $scope . '\Classes\Domain\Model\Content\\' . $scope . 'ReferenceContent'); break;
					default:          $element = Utility::createInstance('\Continut\Extensions\System\\' . $scope . '\Classes\Domain\Model\\' . $scope . 'Content');
				}
				$element->setTitle($row['title']);
				$element->setType($row['type']);
				$element->setValue($row['value']);
				$element->setIsVisible($row['isVisible']);
				$element->setIsDeleted($row['isDeleted']);
				$element->setParent($row['parent']);
				$element->setColumnId($row['columnId']);
				$element->setPage($page);
				$element->setId($row['id']);
				$element->setReferenceId($row['referenceId']);
				$elements[] = $element;
			}
			return $elements;
		}

		/**
		 * Returns all the content elements found on a page as a tree, with children set accordingly
		 *
		 * @param Continut\Core\System\Domain\Model\Page $page
		 *
		 * @return array
		 */
		public function buildTreeForPage($page) {
			return $this->buildTree($this->findWithPage($page));
		}
	}

}
