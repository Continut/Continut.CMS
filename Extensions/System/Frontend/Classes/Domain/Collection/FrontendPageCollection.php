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

	use Continut\Core\System\Domain\Collection\PageCollection;

	class FrontendPageCollection extends PageCollection {

		/**
		 * @param int $domainUrlId Domain Url for which to fetch the pages
		 *
		 * @return array
		 */
		public function buildMenuTree($domainUrlId = 0) {
			$db = $this->getEntityManager()->createQueryBuilder();

			$db->select('p')
				->from($this->_entityName, 'p')
				->where('p.isInMenu = 1')
				->andWhere('p.isVisible = 1')
				->andWhere('p.isDeleted = 0')
				->addOrderBy('p.parent', 'ASC')
				->addOrderBy('p.sorting', 'ASC');
			if ($domainUrlId > 0) {
				$db->andWhere('p.domainUrl = :domainUrl')->setParameter('domainUrl', $domainUrlId);
			}
			return $this->buildTree($db->getQuery()->getResult());
		}
	}

}
