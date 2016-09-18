<?php
/**
 * This file is part of the Conţinut CMS project.
 * Distributed under the GNU General Public License.
 * For more details, consult the LICENSE.txt file supplied with the project
 
 * Author: Radu Mogoş <radu.mogos@pixelplant.ch>
 * Date: 23.04.2015 @ 18:51
 * Project: Conţinut CMS
 */
namespace Extensions\Local\ThemeBootstrap\Classes\Controllers {

	use Continut\Core\Mvc\Controller\FrontendController;
	use Continut\Core\Utility;

	class MenuController extends FrontendController {

		/**
		 * Get all pages for this domain and return them as a tree, for menu generation
		 *
		 * @throws \Continut\Core\Tools\Exception
		 */
		public function showMenuAction() {
			$pageCollection = Utility::createInstance('Continut\Extensions\System\Frontend\Classes\Domain\Collection\FrontendPageCollection')
				->where("is_in_menu = 1 AND is_visible = 1 AND is_deleted = 0 ORDER BY sorting ASC");

			$pageTree = $pageCollection->buildTree();

			$this->getView()->assign("pageTree", $pageTree);
		}
	}

}
