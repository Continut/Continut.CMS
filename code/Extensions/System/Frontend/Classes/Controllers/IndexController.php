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
			$pageUid = (int)$this->getRequest()->getArgument("pid");

			// load the pageview renderer
			$pageView = Utility::createInstance("\\Core\\Mvc\\View\\PageView");

			// get all elements from the database that belong to this page and are not hidden or deleted
			$contentCollection = Utility::createInstance("\\Extensions\\System\\Frontend\\Classes\\Domain\\Collection\\FrontendContentCollection");
			$contentCollection->where("page_uid = :page_uid AND is_deleted = 0 AND is_visible = 1", [":page_uid" => $pageUid ] );

			// create the container elements and make add their child elements insides
			$containers = [];
			foreach ($contentCollection->getAll() as $element) {
				if (!isset($containers[$element->set_uid])) {
					$containers[$element->set_uid] = Utility::createInstance("\\Core\\Mvc\\View\\BackendContainer");
				}
				$containers[$element->set_uid]->addElement($element);
			}

			// -- this needs to be retrieved from the database, from the page settings
			$layout = Utility::createInstance("\\Core\\Mvc\\View\\BaseLayout");
			$layout->setTemplate(__ROOTCMS__ . "/Extensions/Local/News/Resources/Private/Frontend/Layouts/Default.layout.php");
			$pageView->setLayout($layout);
			// -- END

			// send the containers to our layout for rendering
			$pageView->getLayout()->setContainers($containers);

			// dump it all on screen
			return $pageView->render();
		}
	}

}
