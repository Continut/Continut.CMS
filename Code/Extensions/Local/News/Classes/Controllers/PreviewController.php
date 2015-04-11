<?php
/**
 * This file is part of the Conţinut CMS project.
 * Distributed under the GNU General Public License.
 * For more details, consult the LICENSE.txt file supplied with the project
 
 * Author: Radu Mogoş <radu.mogos@pixelplant.ch>
 * Date: 11.04.2015 @ 18:48
 * Project: Conţinut CMS
 */
namespace Extensions\Local\News\Classes\Controllers {

	use Core\Mvc\Controller\BackendController;

	class PreviewController extends BackendController {
		public function backendConfigureAction() {

		}

		public function backendPreviewAction() {
			$this->getView()->assign('limit', $this->settings["limit"]);
		}
	}

}
