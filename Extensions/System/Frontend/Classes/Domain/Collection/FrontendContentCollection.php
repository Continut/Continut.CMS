<?php
/**
 * This file is part of the Conţinut CMS project.
 * Distributed under the GNU General Public License.
 * For more details, consult the LICENSE.txt file supplied with the project

 * Author: Radu Mogoş <radu.mogos@pixelplant.ch>
 * Date: 04.04.2015 @ 12:39
 * Project: Conţinut CMS
 */
namespace Continut\Extensions\System\Frontend\Classes\Domain\Collection {

	use Continut\Core\System\Domain\Collection\ContentCollection;
	use Continut\Core\Utility;

	/**
	 * Class FrontendContentCollection
	 *
	 * @package Continut\Extensions\System\Frontend\Classes\Domain\Collection
	 */
	class FrontendContentCollection extends ContentCollection {

		/**
		 * Returns all the content elements found on a page
		 *
		 * @param int $pageId
		 *
		 * @return array
		 */
		public function findWithPageId($pageId, $isVisible = 1, $isDeleted = 0) {
			$db = $this->getEntityManager()->createQueryBuilder();

			$db->select('p')
				->from($this->_entityName, 'p')
				->where('p.page = :page')
				->andWhere('p.isVisible = :isVisible')
				->andWhere('p.isDeleted = :isDeleted')
				->setParameters([ "page" => $pageId, "isVisible" => $isVisible, "isDeleted" => $isDeleted ])
				->addOrderBy("p.sorting", "ASC");
			$rows = $db->getQuery()->getArrayResult();

			$elements = [];

			foreach ($rows as $row) {
				switch ($row["type"]) {
					case "plugin":    $element = Utility::createInstance('\Continut\Extensions\System\Frontend\Classes\Domain\Model\Content\FrontendPluginContent'); break;
					case "container": $element = Utility::createInstance('\Continut\Extensions\System\Frontend\Classes\Domain\Model\Content\FrontendContainerContent'); break;
					case "reference": $element = Utility::createInstance('\Continut\Extensions\System\Frontend\Classes\Domain\Model\Content\FrontendReferenceContent'); break;
					default:          $element = Utility::createInstance($this->_entityName);
				}
				$element->setTitle($row['title']);
				$element->setType($row['type']);
				$element->setValue($row['value']);
				$element->setIsVisible($row['isVisible']);
				$element->setIsDeleted($row['isDeleted']);
				$element->setParent($row['parent']);
				$element->setColumnId($row['columnId']);
				$element->setPage($row['page']);
				$element->setId($row['id']);
				$elements[] = $element;
			}
			return $elements;
		}

		/**
		 * Returns all the content elements found on a page as a tree, with children set accordingly
		 *
		 * @param int $pageId
		 *
		 * @return array
		 */
		public function buildTreeForPageId($pageId) {
			return $this->buildTree($this->findWithPageId($pageId));
		}
	}

}
