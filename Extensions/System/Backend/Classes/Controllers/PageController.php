<?php
/**
 * This file is part of the Conţinut CMS project.
 * Distributed under the GNU General Public License.
 * For more details, consult the LICENSE.txt file supplied with the project
 * Author: Radu Mogoş <radu.mogos@pixelplant.ch>
 * Date: 25.04.2015 @ 21:18
 * Project: Conţinut CMS
 */
namespace Continut\Extensions\System\Backend\Classes\Controllers;

use Continut\Core\Mvc\Controller\BackendController;
use Continut\Core\Utility;

class PageController extends BackendController
{
    public function __construct()
    {
        parent::__construct();
        $this->setLayoutTemplate(Utility::getResource("Default", "Backend", "Backend", "Layout"));
    }

    /**
     * Called when the pagetree is shown for the page module
     *
     * @throws \Continut\Core\Tools\Exception
     */
    public function indexAction()
    {
        $domainsCollection = Utility::createInstance('Continut\Core\System\Domain\Collection\DomainCollection');
        $domainsCollection->sql("SELECT sys_domains.* FROM sys_domains LEFT JOIN sys_domain_urls ON sys_domains.id=sys_domain_urls.domain_id WHERE sys_domain_urls.domain_id IS NOT NULL AND sys_domains.is_visible =:is_visible GROUP BY (sys_domains.id) ORDER BY sys_domains.sorting ASC", ["is_visible" => 1]);

        $languagesCollection = Utility::createInstance('Continut\Core\System\Domain\Collection\DomainUrlCollection');
        $domainId = ($this->getSession()->get('current_domain')) ? (int)$this->getSession()->get('current_domain') : $domainsCollection->getFirst()->getId();
        $languagesCollection->where("domain_id = :domain_id ORDER BY sorting ASC", ["domain_id" => $domainId]);

        $this->getView()->assign("domains", $domainsCollection);
        $this->getView()->assign("languages", $languagesCollection);
    }

    /**
     * Called when the pagetree changes or needs to be shown for the first time. Responds with a JSON string of the pagetree
     *
     * @param string $term Search term to use
     *
     * @return string
     * @throws \Continut\Core\Tools\Exception
     */
    public function treeAction($term = '')
    {
        /** @var \Continut\Core\System\Domain\Collection\PageCollection $pagesCollection */
        $pagesCollection = Utility::createInstance('Continut\Core\System\Domain\Collection\PageCollection');

        // if a domain/language is already present in the session, then show these ones
        if ($this->getRequest()->hasArgument('domain_id') || $this->getRequest()->hasArgument('domain_url_id')) {
            $domainId    = (int)$this->getRequest()->getArgument('domain_id');
            $domainUrlId = (int)$this->getRequest()->getArgument('domain_url_id', 0);
        } else {
            $domainId    = (int)$this->getSession()->get('current_domain');
            $domainUrlId = (int)$this->getSession()->get('current_language');
        }

        // get the domains collection
        $domainsCollection = Utility::createInstance('Continut\Core\System\Domain\Collection\DomainCollection');

        if ($domainId == 0) {
            // fetch the first visible domain, ordered by sorting, if no domain_id is sent
            $domain = $domainsCollection->where('is_visible = 1 ORDER BY sorting ASC')
                ->getFirst();
        } else {
            $domain = $domainsCollection->where('id = :id ORDER BY sorting ASC', ['id' => $domainId])
                ->getFirst();
        }

        // then the domains url collection
        $domainsUrlCollection = Utility::createInstance('Continut\Core\System\Domain\Collection\DomainUrlCollection');
        // see if a domain url was sent, if not get the first one found for this domain
        if ($domainUrlId == 0) {
            $domainUrl = $domainsUrlCollection->where(
                'domain_id = :domain_id ORDER BY sorting ASC',
                ['domain_id' => $domain->getId()]
            )
                ->getFirst();
        } else {
            $domainUrl = $domainsUrlCollection->where(
                'domain_id = :domain_id AND id = :id ORDER BY sorting ASC',
                ['domain_id' => $domain->getId(), 'id' => $domainUrlId]
            )
                ->getFirst();
        }

        // store the selection in the session so that we can show it once they refresh the page
        if ($domain) {
            $this->getSession()->set('current_domain', $domain->getId());
        }
        // store the language (domain_url)
        if ($domainUrl) {
            $this->getSession()->set('current_language', $domainUrl->getId());
        }

        // if no domain url is found, then unfortunatelly there is nothing that we can show
        if (!$domainUrl) {
            return json_encode(['success' => 0, 'languages' => []]);
        }

        // get all the pages that belong to this domain
        // if the search filter is not empty, filter on page titles
        if (mb_strlen($term) > 0) {
            $pagesCollection->where(
                'domain_url_id = :domain_url_id AND is_deleted = 0 AND title LIKE :title ORDER BY parent_id ASC, sorting ASC',
                [
                    'domain_url_id' => $domainUrl->getId(),
                    'title' => "%$term%"
                ]
            );
        } else {
            $pagesCollection->where(
                'domain_url_id = :domain_url_id AND is_deleted=0 ORDER BY parent_id ASC, sorting ASC',
                [
                    'domain_url_id' => $domainUrl->getId()
                ]
            );
        }

        /** @var \Continut\Core\System\Domain\Collection\DomainUrlCollection $languagesCollection */
        $languagesCollection = Utility::createInstance('Continut\Core\System\Domain\Collection\DomainUrlCollection');
        $languagesCollection->where('domain_id = :domain_id', ['domain_id' => $domain->getId()]);

        $pagesData = [
            'success'   => 1,
            'pages'     => $pagesCollection->buildJsonTree(),
            'languages' => $languagesCollection->toSimplifiedArray()
        ];

        return json_encode($pagesData, JSON_UNESCAPED_UNICODE);
    }

    /**
     * Called when a page's properties are edited in the backend
     *
     * @throws \Continut\Core\Tools\Exception
     */
    public function editAction()
    {
        $pageId = (int)$this->getRequest()->getArgument("page_id");
        $pageModel = Utility::createInstance('Continut\Core\System\Domain\Collection\PageCollection')
            ->where("id = :id", ["id" => $pageId])
            ->getFirst();
        $pageModel->mergeOriginal();

        $layouts = Utility::getLayouts();

        $this->getView()->assign('page', $pageModel);
        $this->getView()->assign('layouts', $layouts);
    }

    /**
     * Called when the page properties are modified and need to be saved
     */
    public function savePropertiesAction()
    {
        $data = $this->getRequest()->getArgument("data");
        $id = (int)$data["id"];

        $pageCollection = Utility::createInstance('Continut\Core\System\Domain\Collection\PageCollection');
        $pageModel = $pageCollection->findById($id);
        // format start date for MySql
        $date = new \DateTime($data['start_date']);
        $data['start_date'] = $date->format('Y-m-d H:i:s');
        // format end date for MySql
        $date = new \DateTime($data['end_date']);
        $data['end_date'] = $date->format('Y-m-d H:i:s');
        // this calls all the "setXYZ" methods for the passed properties present in $data
        $pageModel->update($data);

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
    public function showAction()
    {
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
    public function toggleVisibilityAction()
    {
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
    public function toggleMenuAction()
    {
        $pageId = (int)$this->getRequest()->getArgument("page_id", 0);

        // Load the pages collection model
        $pagesCollection = Utility::createInstance('Continut\Core\System\Domain\Collection\PageCollection');
        $pageModel = $pagesCollection->findById($pageId);

        // @TODO: Cast the value to an int or check for boolean types in the BaseCollection when saving
        //$pageModel->setIsInMenu(1 - $pageModel->getIsInMenu());
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
    public function searchTreeAction()
    {
        $term = $this->getRequest()->getArgument("query", "");

        return $this->treeAction($term);
    }

    /**
     * Saves a page's new parentId once it is moved in the tree
     *
     * @return string
     * @throws \Continut\Core\Tools\Exception
     */
    public function treeMoveAction()
    {
        // We get the id of the page that has been drag & dropped
        $pageId = (int)$this->getRequest()->getArgument("movedId");
        // position of node inside the new node, after drop stops
        $newPosition = $this->getRequest()->getArgument("position");
        // new parent to move into, or after
        $newParentId = (int)$this->getRequest()->getArgument("newParentId");
        // get the new sorting for all pages on the same level
        $orders = $this->getRequest()->getArgument("order");

        // Then we load it's Page Model
        $pagesCollection = Utility::createInstance('Continut\Core\System\Domain\Collection\PageCollection');
        $pageModel = $pagesCollection->where("id = :id", ["id" => $pageId])->getFirst();

        // If the page is valid, we change it's parentId field and then save the value
        if ($pageModel) {
            $pageModel->setParentId($newParentId);
            foreach ($orders as $sortOrder => $pageId) {
                if ($pageModel->getId() == $pageId) {
                    $pageModel->setSorting($sortOrder);
                }
            }

            // get all pages on the parent level
            $pagesOnSameLevel = $pagesCollection->reset()->where('domain_url_id = :domain_url_id AND parent_id = :parent_id ORDER BY sorting ASC', ['domain_url_id' => $pageModel->getDomainUrlId(), 'parent_id' => $newParentId]);
            if ($pagesOnSameLevel->count()) {
                foreach ($pagesOnSameLevel->getAll() as $page) {
                    foreach ($orders as $sortOrder => $pageId) {
                        if ($page->getId() == $pageId) {
                            $page->setSorting($sortOrder);
                        }
                    }
                }
            }/* else {
                $pageModel->setSorting(0);
            }*/

            $pagesOnSameLevel->save();

            $pagesCollection
                ->reset()
                ->add($pageModel)
                ->save();
        }

        return "executed";
    }

    /**
     * Called when a page is deleted
     */
    public function deleteAction()
    {
        $pageId = (int)$this->getRequest()->getArgument("page_id");

        $pagesCollection = Utility::createInstance('Continut\Core\System\Domain\Collection\PageCollection');
        $pageModel = $pagesCollection->findById($pageId);

        $pageModel->setIsDeleted(true);

        $pagesCollection->reset()->add($pageModel)->save();
        // @TODO : show maybe a warning if subpages are present and then delete all tree
        // A page can have multiple children so we get it's tree and we delete all subpages
        //$pageTree = $pagesCollection->where("is_deleted = 0")->buildTree($pageId);
        return json_encode(["success" => 1]);
    }

    /**
     * Called when the page creation wizard should be displayed
     */
    public function wizardAction()
    {
        $pageId = (int)$this->getRequest()->getArgument("id");
        $pageModel = Utility::createInstance('Continut\Core\System\Domain\Collection\PageCollection')
            ->findById($pageId);

        $layouts = Utility::getLayouts();

        $this->getView()->assign('page', $pageModel);
        $this->getView()->assign('layouts', $layouts);
    }

    /**
     * Add one or multiple pages to the tree
     */
    public function addAction()
    {
        $pageId        = (int)$this->getRequest()->getArgument('id');
        $pagePlacement = $this->getRequest()->getArgument('page_placement');
        $pages         = $this->getRequest()->getArgument('data');
        $domainUrlId   = (int)$this->getRequest()->getArgument('domain_url_id');

        // if no domainUrlId is set, it means something went wrong. The domainUrlId cannot be zero
        if ($domainUrlId > 0) {
            $languagesCollection = Utility::createInstance('Continut\Core\System\Domain\Collection\DomainUrlCollection');
            $language = $languagesCollection->findById($domainUrlId);

            // is there any language linked to this domain url id?
            if ($language) {
                $pageCollection = Utility::createInstance('Continut\Core\System\Domain\Collection\PageCollection');
                $savePageCollection = Utility::createInstance('Continut\Core\System\Domain\Collection\PageCollection');

                $languagesCollection = Utility::createInstance('Continut\Core\System\Domain\Collection\DomainUrlCollection');
                $language = $languagesCollection->findById($domainUrlId);

                foreach ($pages["name"] as $index => $title) {
                    $pageModel = Utility::createInstance('Continut\Core\System\Domain\Model\Page');
                    // added inside a selected page, at the very end of already existing pages
                    if ($pagePlacement == "inside") {
                        $pageModel->setParentId($pageId);
                        $lastPage = $pageCollection
                            ->where('parent_id = :parent_id AND domain_url_id = :domain_url_id ORDER BY sorting DESC', ['domain_url_id' => $domainUrlId, 'parent_id' => $pageId])
                            ->getFirst();
                        // if we don't have any page so far, just set the new one's sorting order to 1
                        if ($lastPage) {
                            // and add this new page at the very end of the page tree
                            $pageModel->setSorting((int)$lastPage->getSorting() + 1);
                        } else {
                            $pageModel->setSorting(1);
                        }
                    } else {
                        // added directly to the root, at the very end of all existing pages
                        if ($pageId == 0) {
                            $pageModel->setParentId(0);
                            // get the biggest sorting value for all pages already existing on the root level
                            $lastPage = $pageCollection->where('parent_id = 0 ORDER BY sorting DESC')->getFirst();
                            // if we don't have any page so far, just set the new one's sorting order to 1
                            if ($lastPage) {
                                // and add this new page at the very end of the page tree
                                $pageModel->setSorting((int)$lastPage->getSorting() + 1);
                            } else {
                                $pageModel->setSorting(1);
                            }
                        // added "before" or "after" the selected page
                        } else {
                            $parentPage = $pageCollection->findById($pageId);
                            $pageModel->setParentId($parentPage->getParentId());
                            if ($pagePlacement == "before") {
                                // BEFORE
                                $pageModel->setSorting((int)$parentPage->getSorting());
                                // update all other pages AFTER this new one and set their sorting order + 1
                                $otherPages = $pageCollection->where('parent_id = :parent_id AND sorting >= :sorting ORDER BY sorting ASC',
                                    [
                                        ':parent_id' => $parentPage->getParentId(),
                                        ':sorting' => $parentPage->getSorting()
                                    ]);
                                $pageCollection->reset();
                                foreach ($otherPages as $sortedPage) {
                                    $sortedPage->setSorting((int)$sortedPage->getSorting() + 1);
                                    $pageCollection->add($sortedPage);
                                }
                                $pageCollection->save();
                            } else {
                                // AFTER
                                $pageModel->setSorting((int)$parentPage->getSorting() + 1);
                                // update all other pages AFTER this new one and set their sorting order + 1
                                $otherPages = $pageCollection->where('parent_id = :parent_id AND sorting > :sorting ORDER BY sorting ASC',
                                    [
                                        ':parent_id' => $parentPage->getParentId(),
                                        ':sorting' => $parentPage->getSorting()
                                    ]);
                                $pageCollection->reset();
                                foreach ($otherPages as $sortedPage) {
                                    $sortedPage->setSorting((int)$sortedPage->getSorting() + 1);
                                    $pageCollection->add($sortedPage);
                                }
                                $pageCollection->save();
                            }
                        }
                    }
                    // @TODO: check why you need to set the iso3 per page. Forgot why I added this!!!
                    //$pageModel->setLanguageIso3($language->getLanguageIso3());
                    $pageModel
                        ->setSlug($title)
                        ->setIsDeleted(false)
                        // @TODO : check if a translation or not
                        ->setOriginalId(0)
                        ->setTitle($title)
                        ->setDomainUrlId($language->getId());

                    // set page visibility
                    if ($pages['visibility'][$index]) {
                        switch ($pages['visibility'][$index]) {
                            case 'visible':        $pageModel->setIsVisible(true)->setIsInMenu(true); break;
                            case 'hidden_in_menu': $pageModel->setIsVisible(true)->setIsInMenu(false); break;
                            default:               $pageModel->setIsVisible(false);
                        }
                    }

                    // set page layout
                    if ($pages['layout'][$index]) {
                        $pageModel->setLayout($pages['layout'][$index]);
                    }

                    $savePageCollection
                        ->add($pageModel);
                }

                $savePageCollection->save();

                // return all the new inserted pages as json objects so that we can update the jsTree data
                $jsonPages = [];
                foreach ($savePageCollection->getAll() as $page) {
                    $jsonPageData = [
                        'node'     => ['id' => $page->getId(), 'text' => $page->getTitle(), 'icon' => 'fa fa-file'],
                        // jsTree needs '#' for root nodes so parentId == 0 is ignored
                        'parent'   => ((int)$page->getParentId() > 0) ? $page->getParentId() : '#',
                        'position' => $pagePlacement
                    ];
                    $jsonPages[] = $jsonPageData;
                }

                return json_encode(
                    [
                        'success' => 1,
                        'pages'   => $jsonPages
                    ]
                );
            }
        }

        // @TODO: check for errors and return them
        return json_encode(['success' => 0, 'error' => '@TODO']);
    }
}
