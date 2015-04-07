<?php
/**
 * This file is part of the Conţinut CMS project.
 * Distributed under the GNU General Public License.
 * For more details, consult the LICENSE.txt file supplied with the project
 
 * Author: Radu Mogoş <radu.mogos@pixelplant.ch>
 * Date: 04.04.2015 @ 13:16
 * Project: Conţinut CMS
 */
namespace Extensions\System\Frontend\Classes\Controllers {

	use Core\Mvc\Controller\FrontendController;
	use Core\Utility;

	class IndexController extends FrontendController {

		public function indexAction() {
			// get page id request
			$pageUid = (int)$this->getRequest()->getArgument("pid", 1);

			if ($cache = Utility::getCache()->getByUid($pageUid, "page")) {
				return $cache;
			} else {

				// Load the page model from the database
				$pageModel = Utility::createInstance("\\Extensions\\System\\Frontend\\Classes\\Domain\\Collection\\FrontendPageCollection")
					->where("uid = :uid", ["uid" => $pageUid])
					->getFirst();

				// load the pageview renderer
				$pageView = Utility::createInstance("\\Core\\Mvc\\View\\PageView");

				// get all elements from the database that belong to this page and are not hidden or deleted
				$contentCollection = Utility::createInstance("\\Extensions\\System\\Frontend\\Classes\\Domain\\Collection\\FrontendContentCollection");
				$contentCollection->where("page_uid = :page_uid AND is_deleted = 0 AND is_visible = 1", [":page_uid" => $pageUid]);

				// Build content tree
				$children = [];

				foreach ($contentCollection->getAll() as $item) {
					$item->setPage($pageView);
					$children[$item->getParentUid()][] = $item;
				}

				foreach ($contentCollection->getAll() as $item) {
					if (isset($children[$item->getUid()])) {
						$item->children = $children[$item->getUid()];
					} else {
						$item->children = [];
					}
				}

				$tree = NULL;
				if (isset($children[0])) {
					$tree = $children[0];
				}

				// -- this needs to be retrieved from the database, from the page settings
				$layout = Utility::createInstance("\\Core\\System\\View\\FrontendLayout");
				$layout->setTemplate(__ROOTCMS__ . $pageModel->getLayout());
				$pageView->setLayout($layout);
				// -- END

				// send the containers to our layout for rendering
				//$pageView->getLayout()->setContainers($firstContainers, $containers);
				$pageView->getLayout()->setElements($tree);

				$pageView->setTitle($pageModel->getTitle());

				// dump it all on screen
				$cache = $pageView->render();
				Utility::getCache()->setByUid($pageUid, "page", $cache);
			}
			return $cache;
		}
	}

}
