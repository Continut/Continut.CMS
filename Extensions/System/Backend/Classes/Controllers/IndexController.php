<?php
/**
 * This file is part of the Conţinut CMS project.
 * Distributed under the GNU General Public License.
 * For more details, consult the LICENSE.txt file supplied with the project

 * Author: Radu Mogoş <radu.mogos@pixelplant.ch>
 * Date: 29.03.2015 @ 18:43
 * Project: Conţinut CMS
 */

namespace Extensions\System\Backend\Classes\Controllers {
	use \Core\Mvc\Controller\BackendController;
	use \Core\Utility;

	/**
	 * Backend main controller
	 * @package System\Backend\Classes\Controllers
	 */
	class IndexController extends BackendController {

		public function __construct() {
			parent::__construct();
			$this->setLayoutTemplate(Utility::getResource("Default", "Backend", "Backend", "Layout"));
		}

		/**
		 * Main dashboard action
		 *
		 * @return string
		 */
		public function dashboardAction() {
		}

		/**
		 * Render the Backend mainmenu based on configuration done in the configuration.json file of every extension
		 * The backend menu items and submenu items are configured inside the "backend" key
		 */
		public function mainmenuAction() {
			$allExtensionsSettings = Utility::getExtensionSettings();

			$mainMenu = [];
			$secondaryMenu = [];

			foreach ($allExtensionsSettings as $extensionName => $configuration) {
				if (isset($configuration["backend"])) {
					if (isset($configuration["backend"]["mainMenu"])) {
						$mainMenu = array_merge_recursive($mainMenu, $configuration["backend"]["mainMenu"]);
					}
					if (isset($configuration["backend"]["secondaryMenu"])) {
						$secondaryMenu = array_merge_recursive($secondaryMenu, $configuration["backend"]["secondaryMenu"]);
					}
				}
			}

			$this->getView()->assign("mainMenu", $mainMenu);
			$this->getView()->assign("secondaryMenu", $secondaryMenu);
		}

	}
}