<?php
/**
 * This file is part of the Conţinut CMS project.
 * Distributed under the GNU General Public License.
 * For more details, consult the LICENSE.txt file supplied with the project
 
 * Author: Radu Mogoş <radu.mogos@pixelplant.ch>
 * Date: 25.04.2015 @ 21:18
 * Project: Conţinut CMS
 */
namespace Continut\Extensions\System\Backend\Classes\Controllers {

	use Continut\Core\Mvc\Controller\BackendController;
	use Continut\Core\Utility;

	class PageController extends BackendController {

		public function __construct() {
			parent::__construct();
			$this->setLayoutTemplate(Utility::getResource("Default", "Backend", "Backend", "Layout"));
		}

		/**
		 * Called when the pagetree is shown for the page module
		 *
		 * @throws \Continut\Core\Tools\Exception
		 */
		public function indexAction() {
			$domainsCollection = Utility::createInstance('Continut\Core\System\Domain\Collection\DomainCollection');
			$domainsCollection->sql("SELECT sys_domains.* FROM sys_domains LEFT JOIN sys_domain_urls ON sys_domains.id=sys_domain_urls.domain_id WHERE sys_domain_urls.domain_id IS NOT NULL AND sys_domains.is_visible =:is_visible GROUP BY (sys_domains.id) ORDER BY sys_domains.sorting ASC", ["is_visible" => 1]);

			$languagesCollection = Utility::createInstance('Continut\Core\System\Domain\Collection\DomainUrlCollection');
			$languagesCollection->where("domain_id = :domain_id ORDER BY sorting ASC", ["domain_id" => $domainsCollection->getFirst()->getId()]);

			$this->getView()->assign("domains", $domainsCollection);
			$this->getView()->assign("languages", $languagesCollection);
		}

		/**
		 * Called when the pagetree changes or needs to be shown for the first time. Responds with a JSON string of the pagetree
		 *
		 * @param string $term Search term to use
		 * @return string
		 * @throws \Continut\Core\Tools\Exception
		 */
		public function treeAction($term = "") {
			$pagesCollection = Utility::createInstance('Continut\Core\System\Domain\Collection\PageCollection');

			// get the domains collection
			$domainsCollection = Utility::createInstance('Continut\Core\System\Domain\Collection\DomainCollection');

			$domainId = $this->getRequest()->getArgument("domain_id", 0);
			if ($domainId == 0) {
				// fetch the first visible domain, ordered by sorting, if no domain_id is sent
				$domain = $domainsCollection->where("is_visible = 1 ORDER BY sorting ASC")
					->getFirst();
			} else {
				$domain = $domainsCollection->where("id = :id ORDER BY sorting ASC", [ "id" => $domainId ])
					->getFirst();
			}

			// then the domains url collection
			$domainsUrlCollection = Utility::createInstance('Continut\Core\System\Domain\Collection\DomainUrlCollection');
			// see if a domain url was sent, if not get the first one found for this domain
			$domainUrlId = $this->getRequest()->getArgument("domain_url_id", 0);
			if ($domainUrlId == 0) {
				$domainUrl = $domainsUrlCollection->where(
					"domain_id = :domain_id ORDER BY sorting ASC",
					[ "domain_id" => $domain->getId() ]
				)
					->getFirst();
			} else {
				$domainUrl = $domainsUrlCollection->where(
					"domain_id = :domain_id AND id = :id ORDER BY sorting ASC",
					[ "domain_id" => $domain->getId(), "id" => $domainUrlId ]
				)
					->getFirst();
			}

			// if no domain url is found, then unfortunatelly there is nothing that we can show
			if (!$domainUrl) {
				return json_encode(["success" => 0, "languages" => []]);
			}

			// get all the pages that belong to this domain
			// if the search filter is not empty, filter on page titles
			if (mb_strlen($term) > 0) {
				$pagesCollection->where(
					"domain_url_id = :domain_url_id AND title LIKE :title ORDER BY parent_id ASC, sorting ASC",
					[ "domain_url_id" => $domainUrl->getId(), "title" => "%$term%" ]
				);
			} else {
				$pagesCollection->where(
					"domain_url_id = :domain_url_id ORDER BY parent_id ASC, sorting ASC",
					[ "domain_url_id" => $domainUrl->getId() ]
				);
			}

			$languagesCollection = Utility::createInstance('Continut\Core\System\Domain\Collection\DomainUrlCollection');
			$languagesCollection->where("domain_id = :domain_id", ["domain_id" => $domain->getId()]);

			$pagesData = [
				"success" => 1,
				"pages" => $pagesCollection->buildJsonTree(),
				"languages" => $languagesCollection->toSimplifiedArray()
			];

			return json_encode($pagesData, JSON_UNESCAPED_UNICODE);
		}

		/**
		 * Called when a page's properties are edited in the backend
		 *
		 * @throws \Continut\Core\Tools\Exception
		 */
		public function editAction() {
			$pageId = (int)$this->getRequest()->getArgument("page_id");
			$pageModel = Utility::createInstance('Continut\Core\System\Domain\Collection\PageCollection')
				->where("id = :id", ["id" => $pageId])
				->getFirst();
			$pageModel->mergeOriginal();

			$layouts  = Utility::getLayouts();

			$this->getView()->assign('page', $pageModel);
			$this->getView()->assign('layouts', $layouts);
		}

		/**
		 * Called when the page properties are modified and need to be saved
		 */
		public function savePropertiesAction() {
			$data = $this->getRequest()->getArgument("data");
			$id = (int)$data["id"];

			$pageCollection = Utility::createInstance('Continut\Core\System\Domain\Collection\PageCollection');
			$pageModel = $pageCollection->findById($id);
			$pageModel->update($data);

			// We store a cached version for the FE and BE versions, this way we avoid looking for layouts all the time
			$extensionName = substr($pageModel->getLayout(), 0, strpos($pageModel->getLayout(), "."));
			$layoutId      = substr($pageModel->getLayout(), strlen($extensionName) + 1);
			$settings      = Utility::getExtensionSettings($extensionName);
			if (isset($settings["ui"]["layout"][$layoutId])) {
				$pageModel->setBackendLayout($settings["ui"]["layout"][$layoutId]["backendFile"]);
				$pageModel->setFrontendLayout($settings["ui"]["layout"][$layoutId]["frontendFile"]);
			}

			$pageCollection
				->reset()
				->add($pageModel)
				->save();

			$this->getRequest()->setArgument("page_id", $id);
			$this->forward('show');

			//return json_encode(["success" => 1, "id" => $id]);
		}

		/**
		 * Called when the user clicks on a page in the page tree. It shows the details of the page on the right side
		 *
		 * @throws \Continut\Core\Tools\Exception
		 */
		public function showAction() {
			Utility::debugData("page_rendering", "start", "Page rendering");
			// Load the pages collection model
			$pagesCollection = Utility::createInstance('Continut\Core\System\Domain\Collection\PageCollection');
			// Using the collection, load the page specified in the argument "page_id"
			$pageId = (int)$this->getRequest()->getArgument("page_id", 0);
			$pageModel = $pagesCollection->findById($pageId);
			$pageModel->mergeOriginal();

			// The breadcrumbs path is cached in the variable "cached_path" as a comma separated list of values
			// so that we can easily traverse it in 1 query
			$breadcrumbs = [];
			if ($pageModel->getCachedPath()) {
				$breadcrumbs = $pagesCollection
					->where("id IN (" . $pageModel->getCachedPath() . ") ORDER BY id ASC")
					->getAll();
			}

			// Load the content collection model and then find all the content elements that belong to this page_id
			$contentCollection = Utility::createInstance('Continut\Extensions\System\Backend\Classes\Domain\Collection\BackendContentCollection');
			$contentCollection->where("page_id = :page_id AND is_deleted = 0 ORDER BY sorting ASC", [":page_id" => $pageId]);

			// Since content elements can have containers and be recursive, we need to build a Tree object to handle them
			$contentTree = $contentCollection->buildTree();

			// A PageView is the model that we use to load a layout and render the elements
			$pageView = Utility::createInstance('Continut\Core\System\View\BackendPageView');
			$pageView
				->setPageModel($pageModel)
				->setLayoutFromTemplate(__ROOTCMS__ . $pageModel->getBackendLayout());

			// Send the tree of elements to this page's layout
			$pageView->getLayout()->setElements($contentTree);

			// Render the Tree elements and save them in a variable
			$pageContent = $pageView->render();

			// Send all the data to the view
			$this->getView()->assign("page", $pageModel);
			$this->getView()->assign("pageContent", $pageContent);
			$this->getView()->assign("breadcrumbs", $breadcrumbs);
			Utility::debugData("page_rendering", "stop");
		}

		/**
		 * Hide or show a page in the frontend (toggle it's is_visible value)
		 *
		 * @throws \Continut\Core\Tools\Exception
		 */
		public function toggleVisibilityAction() {
			$pageId = (int)$this->getRequest()->getArgument("page_id", 0);

			// Load the pages collection model
			$pagesCollection = Utility::createInstance('Continut\Core\System\Domain\Collection\PageCollection');
			$pageModel = $pagesCollection->findById($pageId);

			$pageModel->setIsVisible(!$pageModel->getIsVisible());

			$pagesCollection
				->reset()
				->add($pageModel)
				->save();

			return json_encode([
				"visible" => $pageModel->getIsVisible(),
				"pid" => $pageModel->getId()
			]);
		}

		/**
		 * Hide or show a page in any frontend menu (toggle it's is_in_menu value)
		 *
		 * @throws \Continut\Core\Tools\Exception
		 */
		public function toggleMenuAction() {
			$pageId = (int)$this->getRequest()->getArgument("page_id", 0);

			// Load the pages collection model
			$pagesCollection = Utility::createInstance('Continut\Core\System\Domain\Collection\PageCollection');
			$pageModel = $pagesCollection->findById($pageId);

			$pageModel->setIsInMenu(!$pageModel->getIsInMenu());

			$pagesCollection
				->reset()
				->add($pageModel)
				->save();

			//$this->getView()->assign("page", $pageModel);
			return json_encode([
				"isInMenu" => $pageModel->getIsInMenu(),
				"pid" => $pageModel->getId()
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
		 * Saves a page's new parentId once it is moved in the tree
		 *
		 * @return string
		 * @throws \Continut\Core\Tools\Exception
		 */
		public function treeMoveAction() {
			// We get the id of the page that has been drag & dropped
			$pageId = (int)$this->getRequest()->getArgument("movedId");
			// move type can be "after", "before" or "inside"
			$moveType = $this->getRequest()->getArgument("position");
			// new parent to move into, or after
			$newParentId = (int)$this->getRequest()->getArgument("newParentId");

			// Then we load it's Page Model
			$pagesCollection = Utility::createInstance('Continut\Core\System\Domain\Collection\PageCollection');
			$pageModel = $pagesCollection->where("id = :id", ["id" => $pageId])->getFirst();

			// If the page is valid, we change it's parentId field and then save the value
			if ($pageModel) {
				switch ($moveType) {
					// if it's moved inside a page then it's easy, we just get it's parent
					case "inside":
						$pageModel->setParentId($newParentId);
						// for jqTree INSIDE is actually when it will be the first child of this parent
						// so we need to get the current sorting of it's child, if any, and update the sorting
						$firstChild = $pagesCollection->where("parent_id = :parent_id ORDER BY sorting ASC", ["parent_id" => $newParentId])
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
						$otherPage = $pagesCollection->where("id = :id", ["id" => $newParentId])
							->getFirst();
						// if it's on a different level, set the new parent
						if ($otherPage->getParentId() != $pageModel->getParentId()) {
							$pageModel->setParentId($otherPage->getParentId());
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
						$otherPage = $pagesCollection->where("id = :id", ["id" => $newParentId])
							->getFirst();
						if ($otherPage->getParentId() != $pageModel->getParentId()) {
							$pageModel->setParentId($otherPage->getParentId());
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
				/*$pageModel->setCachedPath(implode(",", $pagesCollection->cachedBreadcrumb($pageModel->getParentId())));
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
			$pageId = (int)$this->getRequest()->getArgument("pid");

			$pagesCollection = Utility::createInstance('Continut\Core\System\Domain\Collection\PageCollection');
			// A page can have multiple children so we get it's tree and we delete all subpages
			$pageTree = $pagesCollection->where("is_deleted = 0")->buildTree($pageId);

		}

		/**
		 * Called when the page creation wizard should be displayed
		 */
		public function wizardAction() {
			$pageId = (int)$this->getRequest()->getArgument("id");
			$pageModel = Utility::createInstance('Continut\Core\System\Domain\Collection\PageCollection')
				->findById($pageId);

			$this->getView()->assign('page', $pageModel);
		}

		/**
		 * Add one or multiple pages to the tree
		 */
		public function addAction() {
			$pageId = (int)$this->getRequest()->getArgument("id");
			$pagePlacement = $this->getRequest()->getArgument("page_placement");
			$pages = $this->getRequest()->getArgument("page");

			$pageCollection = Utility::createInstance('Continut\Core\System\Domain\Collection\PageCollection');

			foreach ($pages["names"] as $title) {
				$pageModel = Utility::createInstance('Continut\Core\System\Domain\Model\Page');
				if ($pagePlacement == "inside") {
					$pageModel->setParentId($pageId);
				}
				$pageModel->setLanguageIso3("rou");
				$pageModel->setSlug($title);
				$pageModel->setOriginalId(0);
				$pageModel->setTitle($title);
				//$pageModel->setDomainUrlId(Utility::getSite()->getDomainUrl()->getId());

				$pageCollection->add($pageModel);
			}

			$pageCollection->save();

			return "";

		}

	}

}
