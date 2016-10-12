<?php
/**
 * This file is part of the Conţinut CMS project.
 * Distributed under the GNU General Public License.
 * For more details, consult the LICENSE.txt file supplied with the project
 * Author: Radu Mogoş <radu.mogos@pixelplant.ch>
 * Date: 18.09.2016 @ 11:53
 * Project: Conţinut CMS
 */
namespace Continut\Extensions\System\Editor\Classes\Controllers;

use Continut\Core\Tools\Exception;
use Continut\Core\Utility;
use Continut\Extensions\System\Backend\Classes\Controllers\PageController as BackendPageController;

/**
 * Class IndexController
 *
 * The Frontend Editing controller that returns the page with all the required wraps for the frontend editor
 *
 * @package Continut\Extensions\System\Frontend\Classes\Controllers\Editor
 */
class PageController extends BackendPageController
{
    public function __construct() {
        $this->setUseLayout(false);
        parent::__construct();
    }

    public function indexAction()
    {
        // get page id request
        $pageId = (int)$this->getRequest()->getArgument("pid");

        // Load the page model from the database, by id or slug
        $pageModel = Utility::createInstance('Continut\Extensions\System\Frontend\Classes\Domain\Collection\FrontendPageCollection')
            ->findById($pageId);

        if (!$pageModel) {
            throw new Exception($this->__("exception.page.notFound"));
        }

        // disable debugging in this view, no matter the settings
        Utility::setConfiguration("System/Debug/Enabled", FALSE);

        // merge a translated page's values with the parent one, for default values that should be inherited
        $pageModel->mergeOriginal();

        // load the pageview renderer
        $pageView = Utility::createInstance('Continut\Core\Mvc\View\PageView');

        // get all elements from the database (including hidden, as they might be toggled, but not deleted ones, as deleted ones need to be restored)
        $contentCollection = Utility::createInstance('Continut\Extensions\System\Frontend\Classes\Domain\Collection\FrontendContentCollection');
        $contentCollection->where("page_id = :page_id AND is_deleted = 0 ORDER BY sorting ASC", [":page_id" => $pageModel->getId()]);

        $contentTree = $contentCollection->buildTree();

        $pageView
            ->setPageModel($pageModel)
            ->setLayoutFromTemplate(__ROOTCMS__ . $pageModel->getFrontendLayout());

        $pageView->getLayout()->setElements($contentTree);

        $pageView->setTitle($pageModel->getTitle());

        return $pageView->render();
    }

    /**
     * @param string $term Optional search test
     *
     * @return string JSON page tree
     */
    public function treeAction($term = '') {
        /** @var \Continut\Core\System\Domain\Collection\PageCollection $pagesCollection */
        $pagesCollection = Utility::createInstance('Continut\Core\System\Domain\Collection\PageCollection');

        // get the domains collection
        $domainsCollection = Utility::createInstance('Continut\Core\System\Domain\Collection\DomainCollection');

        $domainId = $this->getRequest()->getArgument("domain_id", 0);
        if ($domainId == 0) {
            // fetch the first visible domain, ordered by sorting, if no domain_id is sent
            $domain = $domainsCollection->where("is_visible = 1 ORDER BY sorting ASC")
                ->getFirst();
        } else {
            $domain = $domainsCollection->where("id = :id ORDER BY sorting ASC", ["id" => $domainId])
                ->getFirst();
        }

        // then the domains url collection
        $domainsUrlCollection = Utility::createInstance('Continut\Core\System\Domain\Collection\DomainUrlCollection');
        // see if a domain url was sent, if not get the first one found for this domain
        $domainUrlId = $this->getRequest()->getArgument("domain_url_id", 0);
        if ($domainUrlId == 0) {
            $domainUrl = $domainsUrlCollection->where(
                "domain_id = :domain_id ORDER BY sorting ASC",
                ["domain_id" => $domain->getId()]
            )
                ->getFirst();
        } else {
            $domainUrl = $domainsUrlCollection->where(
                "domain_id = :domain_id AND id = :id ORDER BY sorting ASC",
                ["domain_id" => $domain->getId(), "id" => $domainUrlId]
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
                ["domain_url_id" => $domainUrl->getId(), "title" => "%$term%"]
            );
        } else {
            $pagesCollection->where(
                "domain_url_id = :domain_url_id ORDER BY parent_id ASC, sorting ASC",
                ["domain_url_id" => $domainUrl->getId()]
            );
        }

        header('Content-Type: application/json');
        return json_encode($pagesCollection->buildJsonTree());
    }

    /**
     * Return page details as JSON object
     *
     * @return string
     */
    public function pageDetailsAction() {
        $pageId = (int)$this->getRequest()->getArgument("id");

        $returnData = [];

        if ($pageId) {
            $pagesCollection = Utility::createInstance('Continut\Extensions\System\Editor\Classes\Domain\Collection\PageCollection');

            $page = $pagesCollection->findById($pageId);

            if ($page) {
                $returnData = $page->arrayForEditor();
            }
        }

        header('Content-Type: application/json');
        return json_encode($returnData);
    }
}
