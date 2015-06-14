<?php
/**
 * This file is part of the Conţinut CMS project.
 * Distributed under the GNU General Public License.
 * For more details, consult the LICENSE.txt file supplied with the project
 
 * Author: Radu Mogoş <radu.mogos@pixelplant.ch>
 * Date: 31.05.2015 @ 22:28
 * Project: Conţinut CMS
 */
namespace Extensions\Local\News\Classes\Controllers {
	use Core\Mvc\Controller\BackendController;
	use Core\Utility;

	class NewsBackendController extends BackendController{

		public function __construct() {
			parent::__construct();
			$this->setLayoutTemplate(Utility::getResource("Default", "Backend", "Backend", "Layout"));
		}

		public function showNewsAction() {

		}
	}

}
