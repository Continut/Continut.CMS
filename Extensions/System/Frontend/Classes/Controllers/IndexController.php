<?php
/**
 * This file is part of the Conţinut CMS project.
 * Distributed under the GNU General Public License.
 * For more details, consult the LICENSE.txt file supplied with the project
 * Author: Radu Mogoş <radu.mogos@pixelplant.ch>
 * Date: 04.04.2015 @ 13:16
 * Project: Conţinut CMS
 */
namespace Continut\Extensions\System\Frontend\Classes\Controllers;

use Continut\Core\Mvc\Controller\FrontendController;
use Continut\Core\Tools\Exception;
use Continut\Core\Tools\HttpException;
use Continut\Core\Utility;

class IndexController extends FrontendController
{
    public function indexAction()
    {
        //Utility::debugData('page_rendering', 'start', 'Page rendering');
        // get page id request
        $pageId = (int)$this->getRequest()->getArgument('id');
        // or slug, whichever is sent
        $pageSlug = $this->getRequest()->getArgument('slug');

        /*if ($cache = Utility::getCache()->getByUid($pageId, 'page')) {
            return $cache;
        } else {*/

        // Load the page model from the database, by id or slug
        $pageModel = Utility::createInstance('Continut\Extensions\System\Frontend\Classes\Domain\Collection\FrontendPageCollection')
            ->findWithIdOrSlug($pageId, $pageSlug);

        if (!$pageModel) {
            // throw a 404 notFound page
            throw new HttpException(404, $this->__('exception.page.notFound'));
        }
        $pageModel->mergeOriginal();

        // load the pageview renderer
        $pageView = Utility::createInstance('Continut\Core\Mvc\View\PageView');

        // get all elements from the database that belong to this page and are not hidden or deleted
        $contentCollection = Utility::createInstance('Continut\Extensions\System\Frontend\Classes\Domain\Collection\FrontendContentCollection');
        $contentCollection->where("page_id = :page_id AND is_deleted = 0 AND is_visible = 1 ORDER BY sorting ASC", [":page_id" => $pageModel->getId()]);

        $contentTree = $contentCollection->buildTree();

        $pageView
            ->setPageModel($pageModel)
            ->setLayoutFromTemplate(__ROOTCMS__ . $pageModel->getFrontendLayout());

        // send the containers to our layout for rendering
        //$pageView->getLayout()->setContainers($firstContainers, $containers);
        $pageView->getLayout()->setElements($contentTree);

        $pageView->setTitle($pageModel->getTitle());

        // dump it all on screen
        $cache = $pageView->render();
        //Utility::getCache()->setByUid($pageId, 'page', $cache);
        //}
        //Utility::debugData('page_rendering', 'stop');
        return $cache;
    }
}
