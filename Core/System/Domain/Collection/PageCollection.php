<?php
/**
 * This file is part of the Conţinut CMS project.
 * Distributed under the GNU General Public License.
 * For more details, consult the LICENSE.txt file supplied with the project

 * Author: Radu Mogoş <radu.mogos@pixelplant.ch>
 * Date: 04.04.2015 @ 12:39
 * Project: Conţinut CMS
 */
namespace Continut\Core\System\Domain\Collection {

	use Continut\Core\Mvc\Model\BaseRepository;
	use Continut\Core\Utility;

	class PageCollection extends BaseRepository {

		/**
		 * Build a tree out of the returned pages
		 * Optionally return only the children for a certain child uid
		 *
		 * @return array
		 */
		public function buildTree($items, $childId = 0) {
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
		 * @var array $items
		 *
		 * @return array
		 */
		protected function buildJsonTree($items) {
			$children = [];

			foreach ($items as $item) {
				$data           = new \stdClass();
				$data->id       = $item->getId();
				$data->parentId = $item->getParent();
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
		 * Finds a page either by id, if not zero, or by its slug
		 *
		 * @param int    $id
		 * @param string $slug
		 *
		 * @return Continut\Core\System\Domain\Model\Page
		 */
		public function findWithIdOrSlug($id, $slug) {
			$domainUrlId = Utility::getSite()->getDomainUrl()->getId();

			$db = $this->getEntityManager()->createQueryBuilder();

			if ($id == 0) {
				$db->select('p')
					->from($this->_entityName, 'p')
					->where('p.slug LIKE :slug')
					->andWhere('p.isVisible = 1')
					->andWhere('p.isDeleted = 0')
					->andWhere('p.domainUrl = :domainUrl ')
					->setParameters([ "slug" => $slug, "domainUrl" => $domainUrlId ])
					->setMaxResults(1);
				$page = $db->getQuery()->getOneOrNullResult();
			} else {
				$db->select('p')
					->from($this->_entityName, 'p')
					->where('id = :id')
					->andWhere('p.isVisible = 1')
					->andWhere('p.isDeleted = 0')
					->andWhere('p.domainUrl = :domainUrl ')
					->setParameters([ "id" => $id, "domainUrl" => $domainUrlId ])
					->setMaxResults(1);
				$page = $db->getQuery()->getOneOrNullResult();
			}
			// if no id or slug is provided we should show the homepage, if one exists
			if (!$page) {
				$db->select('p')
					//->from($this->_entityName, 'p')
					->where('p.parent = 0')
					->andWhere('p.isVisible = 1')
					->andWhere('p.isDeleted = 0')
					->andWhere('p.domainUrl = :domainUrl ')
					->setParameters(["domainUrl" => $domainUrlId ])
					->orderBy("p.sorting", "ASC")
					->setMaxResults(1);
				$page = $db->getQuery()->getOneOrNullResult();
			}

			return $page;
		}

		/**
		 * @param Continut\Core\System\Domain\Model\Domain $domainUrl
		 * @param string $term
		 *
		 * @return mixed
		 * @throws \Doctrine\ORM\NonUniqueResultException
		 */
		public function findLikeInDomainUrl($domainUrl, $term = "") {
			$db = $this->getEntityManager()->createQueryBuilder();

			$db->select('p')
				->from($this->_entityName, 'p')
				->where('p.domainUrl = :domainUrl')
				->setParameter("domainUrl", $domainUrl)
				->addOrderBy("p.parent", "ASC")
				->addOrderBy("p.sorting", "ASC");
			if (mb_strlen($term) > 0) {
				$db->andWhere('p.title LIKE :term')
					->setParameter("term", "%$term%");
			}
			return $db->getQuery()->getResult();
		}

		/**
		 * Returns a JSON tree of pages belonging to a domainUrl
		 *
		 * @param Continut\Core\System\Domain\Model\Domain $domainUrl
		 * @param string $term Search term
		 *
		 * @return array
		 */
		public function backendJsonTree($domainUrl, $term) {
			return $this->buildJsonTree($this->findLikeInDomainUrl($domainUrl, $term));
		}
	}

}
