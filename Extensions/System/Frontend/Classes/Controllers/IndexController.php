<?php
/**
 * This file is part of the Conţinut CMS project.
 * Distributed under the GNU General Public License.
 * For more details, consult the LICENSE.txt file supplied with the project
 
 * Author: Radu Mogoş <radu.mogos@pixelplant.ch>
 * Date: 04.04.2015 @ 13:16
 * Project: Conţinut CMS
 */
namespace Continut\Extensions\System\Frontend\Classes\Controllers {

	use Continut\Core\Mvc\Controller\FrontendController;
	use Continut\Core\Tools\Exception;
	use Continut\Core\Utility;

	class IndexController extends FrontendController {

		public function indexAction() {
			//Utility::debugData("page_rendering", "start", "Page rendering");
			// get page id request
			$pageId = (int)$this->getRequest()->getArgument("pid");
			// or slug, whichever is sent
			$pageSlug = $this->getRequest()->getArgument("slug");

			/*if ($cache = Utility::getCache()->getById($pageId, "page")) {
				return $cache;
			} else {*/

			// Load the page model from the database, by id or slug
			$page = Utility::$entityManager->getRepository('Continut\Core\System\Domain\Model\Page')->findWithIdOrSlug($pageId, $pageSlug);

			if (!$page) {
				throw new Exception($this->__("exception.page.notFound"));
			}
			$page->mergeOriginal();

			// load the pageview renderer
			$pageView = Utility::createInstance("\\Continut\\Core\\Mvc\\View\\PageView");

			// get all elements from the database that belong to this page and are not hidden or deleted
			$contentTree = Utility::$entityManager->getRepository('Continut\Extensions\System\Frontend\Classes\Domain\Model\FrontendContent')->buildTreeForPageId($page->getId());

			$pageView
				->setPageModel($page)
				->setLayoutFromTemplate(__ROOTCMS__ . $page->getFrontendLayout());

			// send the containers to our layout for rendering
			//$pageView->getLayout()->setContainers($firstContainers, $containers);
			$pageView->getLayout()->setElements($contentTree);

			$pageView->setTitle($page->getTitle());

			// dump it all on screen
			$cache = $pageView->render();
				//Utility::getCache()->setById($pageId, "page", $cache);
			//}
			//Utility::debugData("page_rendering", "stop");
			return $cache;
		}
	}

}
