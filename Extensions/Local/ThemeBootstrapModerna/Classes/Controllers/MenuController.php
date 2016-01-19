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
			$pageCollection = Utility::createInstance('Continut\Extensions\System\Frontend\Classes\Domain\Collection\FrontendPageCollection')
				->where(
					"is_in_menu = 1 AND is_visible = 1 AND is_deleted = 0 AND domain_url_id = :domain_url_id ORDER BY parent_id ASC, sorting ASC",
					[ "domain_url_id" => Utility::getSite()->getDomainUrl()->getId() ]
				);

			$pageTree = $pageCollection->buildTree();

			$this->getView()->assign("pageTree", $pageTree);
		}

		public function showFooterAction() {

		}

		public function showBreadcrumbAction() {
			$pagesCollection = Utility::createInstance('Continut\Core\System\Domain\Collection\PageCollection');

			$pageId  = (int)$this->getRequest()->getArgument("pid");
			$pageSlug = $this->getRequest()->getArgument("slug");
			$pageModel = $pagesCollection->findWithIdOrSlug($pageId, $pageSlug);

			$breadcrumbs = [];
			if ($pageModel->getCachedPath()) {
				$breadcrumbs = $pagesCollection
					->where("id IN (" . $pageModel->getCachedPath() . ") ORDER BY id ASC")
					->getAll();
			}

			$this->getView()->assign("breadcrumbs", $breadcrumbs);
			$this->getView()->assign("page", $pageModel);
		}
	}

}
