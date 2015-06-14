<?php
/**
 * This file is part of the Conţinut CMS project.
 * Distributed under the GNU General Public License.
 * For more details, consult the LICENSE.txt file supplied with the project
 
 * Author: Radu Mogoş <radu.mogos@pixelplant.ch>
 * Date: 25.04.2015 @ 21:18
 * Project: Conţinut CMS
 */
namespace Extensions\System\Backend\Classes\Controllers {

	use Core\Mvc\Controller\BackendController;
	use Core\Utility;

	class PageController extends BackendController {

		public function __construct() {
			parent::__construct();
			$this->setLayoutTemplate(Utility::getResource("Default", "Backend", "Backend", "Layout"));
		}

		/**
		 * Called when the pagetree is shown for the page module
		 *
		 * @throws \Core\Tools\Exception
		 */
		public function indexAction() {
			$domainsCollection = Utility::createInstance("\\Core\\System\\Domain\\Collection\\DomainCollection");
			$domainsCollection->where("is_visible = :is_visible ORDER BY sorting ASC", ["is_visible" => 1]);

			$languagesCollection = Utility::createInstance("\\Core\\System\\Domain\\Collection\\LanguageCollection");
			$languagesCollection->where("domain_uid = :domain_uid ORDER BY sorting ASC", ["domain_uid" => $domainsCollection->getFirst()->getUid()]);

			$this->getView()->assign("domains", $domainsCollection);
			$this->getView()->assign("languages", $languagesCollection);
		}

		/**
		 * Called when the pagetree changes or needs to be shown for the first time. Responds with a JSON string of the pagetree
		 *
		 * @param string $term Search term to use
		 * @return string
		 * @throws \Core\Tools\Exception
		 */
		public function treeAction($term = "") {
			$pagesCollection = Utility::createInstance("\\Core\\System\\Domain\\Collection\\PageCollection");

			$domainUid = $this->getRequest()->getArgument("domain_uid", 0);
			if ($domainUid == 0) {
				// get the domains collection
				$domainsCollection = Utility::createInstance("\\Core\\System\\Domain\\Collection\\DomainCollection");
				// and fetch the first visible domain, ordered by sorting
				$domainUid = $domainsCollection->where("is_visible = 1 ORDER BY sorting ASC")
					->getFirst()
					->getUid();
			}
			// get all the pages that belong to this domain
			if (mb_strlen($term) > 0) {
				$pagesCollection->where("domain_uid = :domain_uid AND title LIKE :title ORDER BY sorting ASC", [
					"domain_uid" => $domainUid,
					"title" => "%$term%"
				]);
			} else {
				$pagesCollection->where("domain_uid = :domain_uid ORDER BY sorting ASC", ["domain_uid" => $domainUid]);
			}

			$languagesCollection = Utility::createInstance("\\Core\\System\\Domain\\Collection\\LanguageCollection");
			$languagesCollection->where("domain_uid = :domain_uid", ["domain_uid" => $domainUid]);

			$pagesData = [
				"pages" => $pagesCollection->buildJsonTree(),
				"languages" => $languagesCollection->toSimplifiedArray()
			];

			return json_encode($pagesData, JSON_UNESCAPED_UNICODE);
		}

		/**
		 * Called when a page's properties are edited in the backend
		 *
		 * @throws \Core\Tools\Exception
		 */
		public function editAction() {
			$pageUid = (int)$this->getRequest()->getArgument("page_uid");
			$pageModel = Utility::createInstance("\\Core\\System\\Domain\\Collection\\PageCollection")
				->where("uid = :uid", ["uid" => $pageUid])->getFirst();
			$this->getView()->assign('page', $pageModel);
		}

		/**
		 * Called when the user clicks on a page in the page tree. It shows the details of the page on the right side
		 *
		 * @throws \Core\Tools\Exception
		 */
		public function showAction() {
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
			$contentCollection->where("page_uid = :page_uid AND is_deleted = 0 ORDER BY sorting ASC", [":page_uid" => $pageUid]);

			// Since content elements can have containers and be recursive, we need to build a Tree object to handle them
			$contentTree = $contentCollection->buildTree();

			// A PageView is the model that we use to load a layout and render the elements
			$pageView = Utility::createInstance("\\Core\\System\\View\\BackendPageView");
			$pageView->setLayoutFromTemplate(__ROOTCMS__ . $pageModel->getBackendLayout());

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
		public function toggleVisibilityAction() {
			$pageUid = (int)$this->getRequest()->getArgument("page_uid", 0);

			// Load the pages collection model
			$pagesCollection = Utility::createInstance("\\Core\\System\\Domain\\Collection\\PageCollection");
			$pageModel = $pagesCollection->findByUid($pageUid);

			$pageModel->setIsVisible(!$pageModel->getIsVisible());

			$pagesCollection
				->reset()
				->add($pageModel)
				->save();

			return json_encode([
				"visible" => $pageModel->getIsVisible(),
				"pid" => $pageModel->getUid()
			]);
		}

		/**
		 * Hide or show a page in any frontend menu (toggle it's is_in_menu value)
		 *
		 * @throws \Core\Tools\Exception
		 */
		public function toggleMenuAction() {
			$pageUid = (int)$this->getRequest()->getArgument("page_uid", 0);

			// Load the pages collection model
			$pagesCollection = Utility::createInstance("\\Core\\System\\Domain\\Collection\\PageCollection");
			$pageModel = $pagesCollection->findByUid($pageUid);

			$pageModel->setIsInMenu(!$pageModel->getIsInMenu());

			$pagesCollection
				->reset()
				->add($pageModel)
				->save();

			//$this->getView()->assign("page", $pageModel);
			return json_encode([
				"isInMenu" => $pageModel->getIsInMenu(),
				"pid" => $pageModel->getUid()
			]);
		}

		/**
		 * Search the current page tree
		 *
		 * @return mixed
		 */
		public function searchTreeAction() {
			$term = $this->getRequest()->getArgument("query", "");

			return $this->treeAction($term);
		}

		/**
		 * Saves a page's new parentUid once it is moved in the tree
		 *
		 * @return string
		 * @throws \Core\Tools\Exception
		 */
		public function treeMoveAction() {
			// We get the id of the page that has been drag & dropped
			$pageUid = (int)$this->getRequest()->getArgument("movedId");
			// move type can be "after", "before" or "inside"
			$moveType = $this->getRequest()->getArgument("position");
			// new parent to move into, or after
			$newParentUid = (int)$this->getRequest()->getArgument("newParentId");

			// Then we load it's Page Model
			$pagesCollection = Utility::createInstance("\\Core\\System\\Domain\\Collection\\PageCollection");
			$pageModel = $pagesCollection->where("uid = :uid", ["uid" => $pageUid])->getFirst();

			// If the page is valid, we change it's parentUid field and then save the value
			if ($pageModel) {
				switch ($moveType) {
					// if it's moved inside a page then it's easy, we just get it's parent
					case "inside":
						$pageModel->setParentUid($newParentUid);
						// for jqTree INSIDE is actually when it will be the first child of this parent
						// so we need to get the current sorting of it's child, if any, and update the sorting
						$firstChild = $pagesCollection->where("parent_uid = :parent_uid ORDER BY sorting ASC", ["parent_uid" => $newParentUid])
							->getFirst();
						// if we found the first child, get it's sorting and increment the rest
						if ($firstChild) {
							$pageModel->setSorting($firstChild->getSorting());
							// then we increment by 1 the sorting of all the other pages AFTER this one
							$pagesToModify = $pagesCollection->where("sorting >= :sorting_value", ["sorting_value" => $pageModel->getSorting()]);
							foreach ($pagesToModify->getAll() as $page) {
								$page->setSorting($page->getSorting() + 1);
							}
							$pagesToModify->save();
						}
						// if it does not have any children, we can get the last sorting value and increment it by one
						else
						{
							$highestSorting = $pagesCollection->where("is_deleted = 0 ORDER BY sorting DESC")->getFirst();
							$pageModel->setSorting($highestSorting->getSorting() + 1);
						}
						break;
					// if it's after we need to check if it's on the same level or another one
					case "after":
						$otherPage = $pagesCollection->where("uid = :uid", ["uid" => $newParentUid])
							->getFirst();
						// if it's on a different level, set the new parent
						if ($otherPage->getParentUid() != $pageModel->getParentUid()) {
							$pageModel->setParentUid($otherPage->getParentUid());
						}
						// it will be placed AFTER the element, so we increase it's sorting by 1
						$pageModel->setSorting($otherPage->getSorting() + 1);

						// then we increment by 1 the sorting of all the other pages AFTER this one
						$pagesToModify = $pagesCollection->where("sorting >= :sorting_value", ["sorting_value" => $pageModel->getSorting()]);
						foreach ($pagesToModify->getAll() as $page) {
							$page->setSorting($page->getSorting() + 1);
						}
						$pagesToModify->save();

						break;
					case "before":
						$otherPage = $pagesCollection->where("uid = :uid", ["uid" => $newParentUid])
							->getFirst();
						if ($otherPage->getParentUid() != $pageModel->getParentUid()) {
							$pageModel->setParentUid($otherPage->getParentUid());
						} else {
							$pageModel->setSorting($otherPage->getSorting());
							// then we increment by 1 the sorting of all the other pages AFTER this one
							$pagesToModify = $pagesCollection->where("sorting >= :sorting_value", ["sorting_value" => $pageModel->getSorting()]);
							foreach ($pagesToModify->getAll() as $page) {
								$page->setSorting($page->getSorting() + 1);
							}
							$pagesToModify->save();
						}
						break;
				}
				$pagesCollection
					->reset()
					->add($pageModel)
					->save();
				// save a cached version of the breadcrumb
				/*$pageModel->setCachedPath(implode(",", $pagesCollection->cachedBreadcrumb($pageModel->getParentUid())));
				$pagesCollection
					->reset()
					->add($pageModel)
					->save();*/
			}

			return "executed";
		}

		/**
		 * Called when a page is deleted
		 */
		public function deleteAction() {
			$pageUid = (int)$this->getRequest()->getArgument("pid");

			$pagesCollection = Utility::createInstance("\\Core\\System\\Domain\\Collection\\PageCollection");
			// A page can have multiple children so we get it's tree and we delete all subpages
			$pageTree = $pagesCollection->where("is_deleted = 0")->buildTree($pageUid);

		}

	}

}
