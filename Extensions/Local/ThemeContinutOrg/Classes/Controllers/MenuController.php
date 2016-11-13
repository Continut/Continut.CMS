<?php
/**
 * This file is part of the Conţinut CMS project.
 * Distributed under the GNU General Public License.
 * For more details, consult the LICENSE.txt file supplied with the project
 * Author: Radu Mogoş <radu.mogos@pixelplant.ch>
 * Date: 09.05.2015 @ 16:55
 * Project: Conţinut CMS
 */
namespace Continut\Extensions\Local\ThemeContinutOrg\Classes\Controllers;

use Continut\Core\Mvc\Controller\FrontendController;
use Continut\Core\Utility;

class MenuController extends FrontendController
{
    /**
     * Generates the main menu for the header
     */
    public function showMenuAction()
    {
        // Get all subpages of page "Left menu", which has the id 34
        /** @var \Continut\Extensions\System\Frontend\Classes\Domain\Collection\FrontendPageCollection $pageCollection */
        $leftMenuPages = Utility::createInstance('Continut\Extensions\System\Frontend\Classes\Domain\Collection\FrontendPageCollection')
            ->findByParentId(34);

        // Get all subpages of page "Left menu", which has the id 35
        $rightMenuPages = Utility::createInstance('Continut\Extensions\System\Frontend\Classes\Domain\Collection\FrontendPageCollection')
            ->findByParentId(35);

        //$leftMenu = $pageCollection->buildTree();

        $this->getView()->assign("leftMenuPages", $leftMenuPages);
        $this->getView()->assign("rightMenuPages", $rightMenuPages);
    }

    public function showFooterAction()
    {

    }

    public function showBreadcrumbAction()
    {
        $pagesCollection = Utility::createInstance('Continut\Core\System\Domain\Collection\PageCollection');

        $pageId = (int)$this->getRequest()->getArgument("id");
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
