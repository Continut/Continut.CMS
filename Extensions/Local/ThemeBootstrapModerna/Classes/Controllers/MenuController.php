<?php
/**
 * This file is part of the Conţinut CMS project.
 * Distributed under the GNU General Public License.
 * For more details, consult the LICENSE.txt file supplied with the project
 
 * Author: Radu Mogoş <radu.mogos@pixelplant.ch>
 * Date: 09.05.2015 @ 16:55
 * Project: Conţinut CMS
 */
namespace Extensions\Local\ThemeBootstrapModerna\Classes\Controllers {

	use Core\Mvc\Controller\FrontendController;
	use Core\Utility;

	class MenuController extends FrontendController {

		public function showMenuAction() {
			$pageCollection = Utility::createInstance("\\Extensions\\System\\Frontend\\Classes\\Domain\\Collection\\FrontendPageCollection")
				->where(
					"is_in_menu = 1 AND is_visible = 1 AND is_deleted = 0 AND domain_url_uid = :domain_url_uid ORDER BY sorting ASC",
					[ "domain_url_uid" => Utility::getSite()->getDomainUrl()->getUid() ]
				);

			$pageTree = $pageCollection->buildTree();

			$this->getView()->assign("pageTree", $pageTree);
		}

		public function showFooterAction() {

		}

		public function showBreadcrumbAction() {
			$pagesCollection = Utility::createInstance("\\Core\\System\\Domain\\Collection\\PageCollection");

			$pageUid  = (int)$this->getRequest()->getArgument("pid");
			$pageSlug = $this->getRequest()->getArgument("slug");
			$pageModel = $pagesCollection->findWithUidOrSlug($pageUid, $pageSlug);

			$breadcrumbs = [];
			if ($pageModel->getCachedPath()) {
				$breadcrumbs = $pagesCollection
					->where("uid IN (" . $pageModel->getCachedPath() . ") ORDER BY uid ASC")
					->getAll();
			}

			$this->getView()->assign("breadcrumbs", $breadcrumbs);
			$this->getView()->assign("page", $pageModel);
		}
	}

}
