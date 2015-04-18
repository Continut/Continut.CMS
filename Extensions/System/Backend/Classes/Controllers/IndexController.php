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
				"languages" => $languagesCollection->toSimplifiedArray()
			];

			return json_encode($pagesData, JSON_UNESCAPED_UNICODE);
		}

		/**
		 * Called when the user clicks on a page in the page tree. It shows the details of the page on the right side
		 *
		 * @throws \Core\Tools\Exception
		 */
		public function pageShowAction() {
			// Load the pages collection model
			$pagesCollection = Utility::createInstance("\\Core\\System\\Domain\\Collection\\PageCollection");
			// Using the collection, load the page specified in the argument "page_uid"
			$pageUid = (int)$this->getRequest()->getArgument("page_uid", 0);
			$pageModel = $pagesCollection->where("uid = :uid", ["uid" => $pageUid])->getFirst();

			// The breadcrumbs path is cached in the variable "cached_path" as a comma separated list of values
			// so that we can easily traverse it in 1 query
			$breadcrumbs = [];
			if ($pageModel->getCachedPath()) {
				$breadcrumbs = $pagesCollection
					->where("uid IN (" . $pageModel->getCachedPath() . ") ORDER BY uid ASC")
					->getAll();
			}

			// Load the content collection model and then find all the content elements that belong to this page_uid
			$contentCollection = Utility::createInstance("\\Extensions\\System\\Backend\\Classes\\Domain\\Collection\\BackendContentCollection");
			$contentCollection->where("page_uid = :page_uid AND is_deleted = 0", [":page_uid" => $pageUid]);

			// Since content elements can have containers and be recursive, we need to build a Tree object to handle them
			$contentTree = $contentCollection->buildTree();

			// A PageView is the model that we use to load a layout and render the elements
			$pageView = Utility::createInstance("\\Core\\System\\View\\BackendPageView");
			$pageView->setLayoutFromTemplate($pageModel->getBackendLayout());

			// Send the tree of elements to this page's layout
			$pageView->getLayout()->setElements($contentTree);

			// Render the Tree elements and save them in a variable
			$pageContent = $pageView->render();

			// Send all the data to the view
			$this->getView()->assign("page", $pageModel);
			$this->getView()->assign("pageContent", $pageContent);
			$this->getView()->assign("breadcrumbs", $breadcrumbs);
		}

		/**
		 * Hide or show a page in the frontend (toggle it's is_visible value)
		 *
		 * @throws \Core\Tools\Exception
		 */
		public function pageToggleVisibilityAction() {
			$pageUid = (int)$this->getRequest()->getArgument("page_uid", 0);

			// Load the pages collection model
			$pagesCollection = Utility::createInstance("\\Core\\System\\Domain\\Collection\\PageCollection");
			$pageModel = $pagesCollection->findByUid($pageUid);

			$pageModel->setIsVisible(!$pageModel->getIsVisible());

			$pagesCollection
				->reset()
				->add($pageModel)
				->save();

			$this->getView()->assign("page", $pageModel);
			//return json_encode(["visible" => $pageModel->getIsVisible()]);
		}

		/**
		 * Hide or show a page in any frontend menu (toggle it's is_in_menu value)
		 *
		 * @throws \Core\Tools\Exception
		 */
		public function pageToggleMenuAction() {
			$pageUid = (int)$this->getRequest()->getArgument("page_uid", 0);

			// Load the pages collection model
			$pagesCollection = Utility::createInstance("\\Core\\System\\Domain\\Collection\\PageCollection");
			$pageModel = $pagesCollection->findByUid($pageUid);

			$pageModel->setIsInMenu(!$pageModel->getIsInMenu());

			$pagesCollection
				->reset()
				->add($pageModel)
				->save();

			$this->getView()->assign("page", $pageModel);
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
		 * Saves a page's new parentUid once it is moved in the tree
		 *
		 * @return string
		 * @throws \Core\Tools\Exception
		 */
		public function pageTreeMoveAction() {
			// We get the id of the page that has been drag & dropped
			$pageUid = (int)$this->getRequest()->getArgument("movedId");

			// Then we load it's Page Model
			$pagesCollection = Utility::createInstance("\\Core\\System\\Domain\\Collection\\PageCollection");
			$pageModel = $pagesCollection->where("uid = :uid", ["uid" => $pageUid])->getFirst();

			// If the page is valid, we change it's parentUid field and then save the value
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