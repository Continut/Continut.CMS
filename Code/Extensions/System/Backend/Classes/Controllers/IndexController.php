<?php
/**
 * This file is part of the Conţinut CMS project.
 * Distributed under the GNU General Public License.
 * For more details, consult the LICENSE.txt file supplied with the project

 * Author: Radu Mogoş <radu.mogos@pixelplant.ch>
 * Date: 29.03.2015 @ 18:43
 * Project: Conţinut CMS
 */

namespace Extensions\System\Backend\Classes\Controllers {
	use \Core\Mvc\Controller\BackendController;
	use Core\Utility;

	/**
	 * Backend main controller
	 * @package System\Backend\Classes\Controllers
	 */
	class IndexController extends BackendController {

		/**
		 * Main dashboard action
		 *
		 * @return string
		 */
		public function dashboardAction() {
			return "dashboard";
		}

		/**
		 * Called when the pagetree is shown for the page module
		 *
		 * @throws \Core\Tools\Exception
		 */
		public function pageAction() {
			$domainsCollection = Utility::createInstance("\\Core\\System\\Domain\\Collection\\DomainCollection");
			$domainsCollection->where("is_visible = :is_visible ORDER BY sorting ASC", ["is_visible" => 1]);

			$this->getView()->assign("domains", $domainsCollection);
		}

		/**
		 * Called when the pagetree changes or needs to be shown for the first time. Responds with a JSON string of the pagetree
		 *
		 * @return string
		 * @throws \Core\Tools\Exception
		 */
		public function pageTreeAction() {
			$pagesCollection = Utility::createInstance("\\Core\\System\\Domain\\Collection\\PageCollection");

			$domainUid = $this->getRequest()->getArgument("domain_uid", 0);
			if ($domainUid == 0) {
				// get the domains collection
				$domainsCollection = Utility::createInstance("\\Core\\System\\Domain\\Collection\\DomainCollection");
				// and fetch the first visible domain, ordered by sorting
				$domainUid = $domainsCollection->where("is_visible = :is_visible ORDER BY sorting ASC", ["is_visible" => 1])
					->getFirst()
					->getUid();
			}
			// get all the pages that belong to this domain
			$pagesCollection->where("domain_uid = :domain_uid", ["domain_uid" => $domainUid]);

			$languagesCollection = Utility::createInstance("\\Core\\System\\Domain\\Collection\\LanguageCollection");
			$languagesCollection->where("domain_uid = :domain_uid", ["domain_uid" => $domainUid]);

			$pagesData = [
				"pages" => $pagesCollection->buildJsonTree(),
				"languages" => $languagesCollection->toSimplifiedArray()];

			return json_encode($pagesData, JSON_UNESCAPED_UNICODE);

			//$this->getView()->assign("pages", $pagesCollection);
		}

		public function pageShowAction() {
			$pagesCollection = Utility::createInstance("\\Core\\System\\Domain\\Collection\\PageCollection");
			$pageUid = (int)$this->getRequest()->getArgument("page_uid", 0);
			$pageModel = $pagesCollection->where("uid = :uid", ["uid" => $pageUid])->getFirst();

			$breadcrumbs = [];
			if ($pageModel->getCachedPath()) {
				$breadcrumbs = $pagesCollection
					->where("uid IN (" . $pageModel->getCachedPath() . ") ORDER BY uid ASC")
					->getAll();
			}

			$contentCollection = Utility::createInstance("\\Extensions\\System\\Backend\\Classes\\Domain\\Collection\\BackendContentCollection");
			$contentCollection->where("page_uid = :page_uid AND is_deleted = 0 AND is_visible = 1", [":page_uid" => $pageUid]);

			$contentTree = $contentCollection->buildTree();

			$pageView = Utility::createInstance("\\Core\\Mvc\\View\\PageView");
			$pageView->setLayoutFromTemplate($pageModel->getBackendLayout());

			// send the containers to our layout for rendering
			//$pageView->getLayout()->setContainers($firstContainers, $containers);
			$pageView->getLayout()->setElements($contentTree);

			$containers = $pageView->render();

			$this->getView()->assign("page", $pageModel);
			$this->getView()->assign("containers", $containers);
			$this->getView()->assign("breadcrumbs", $breadcrumbs);
		}

		/**
		 * Render the Backend mainmenu based on configuration done in the configuration.json file of every extension
		 * The backend menu items and submenu items are configured inside the "backend" key
		 */
		public function mainmenuAction() {
			$allExtensionsSettings = Utility::getExtensionSettings();

			$mainMenu = [];
			$secondaryMenu = [];

			foreach ($allExtensionsSettings as $extensionName => $configuration) {
				if (isset($configuration["backend"])) {
					if (isset($configuration["backend"]["mainMenu"])) {
						$mainMenu = array_merge_recursive($mainMenu, $configuration["backend"]["mainMenu"]);
					}
					if (isset($configuration["backend"]["secondaryMenu"])) {
						$secondaryMenu = array_merge_recursive($secondaryMenu, $configuration["backend"]["secondaryMenu"]);
					}
				}
			}

			$this->getView()->assign("mainMenu", $mainMenu);
			$this->getView()->assign("secondaryMenu", $secondaryMenu);
		}

		/**
		 * Saves a page's parentUid once it is moved in the tree
		 *
		 * @return string
		 * @throws \Core\Tools\Exception
		 */
		public function pageTreeMoveAction() {
			$pageUid = (int)$this->getRequest()->getArgument("movedId");

			$pagesCollection = Utility::createInstance("\\Core\\System\\Domain\\Collection\\PageCollection");
			$pageModel = $pagesCollection->where("uid = :uid", ["uid" => $pageUid])->getFirst();

			if ($pageModel) {
				$newParentUid = (int)$this->getRequest()->getArgument("newParentId");
				$pageModel->setParentUid($newParentUid);
				$pagesCollection
					->reset()
					->add($pageModel)
					->save();
			}

			return "executed";
		}
	}
}