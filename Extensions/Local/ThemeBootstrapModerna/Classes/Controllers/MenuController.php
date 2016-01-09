<?php
/**
 * This file is part of the Conţinut CMS project.
 * Distributed under the GNU General Public License.
 * For more details, consult the LICENSE.txt file supplied with the project
 
 * Author: Radu Mogoş <radu.mogos@pixelplant.ch>
 * Date: 09.05.2015 @ 16:55
 * Project: Conţinut CMS
 */
namespace Continut\Extensions\Local\ThemeBootstrapModerna\Classes\Controllers {

	use Continut\Core\Mvc\Controller\FrontendController;
	use Continut\Core\Utility;

	class MenuController extends FrontendController {

		public function showMenuAction() {
			$pageTree = Utility::$entityManager->getRepository('Continut\Extensions\System\Frontend\Classes\Domain\Model\FrontendPage')->buildMenuTree(Utility::getSite()->getDomainUrl()->getId());

			$this->getView()->assign("pageTree", $pageTree);
		}

		public function showFooterAction() {

		}

		public function showBreadcrumbAction() {
			$pages = Utility::$entityManager->getRepository('Continut\Extensions\System\Frontend\Classes\Domain\Model\FrontendPage')->findAll();

			$pageId    = (int)$this->getRequest()->getArgument("pid");
			$pageSlug  = $this->getRequest()->getArgument("slug");
			$page = Utility::$entityManager->getRepository('Continut\Extensions\System\Frontend\Classes\Domain\Model\FrontendPage')->findWithIdOrSlug($pageId, $pageSlug);

			/*$breadcrumbs = [];
			if ($page->getCachedPath()) {
				$breadcrumbs = $pagesCollection
					->where("id IN (" . $page->getCachedPath() . ") ORDER BY id ASC")
					->getAll();
			}*/

			$this->getView()->assign("breadcrumbs", "");
			$this->getView()->assign("page", $page);
		}
	}

}
