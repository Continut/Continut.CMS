<?php
/**
 * This file is part of the Conţinut CMS project.
 * Distributed under the GNU General Public License.
 * For more details, consult the LICENSE.txt file supplied with the project
 
 * Author: Radu Mogoş <radu.mogos@pixelplant.ch>
 * Date: 20.04.2015 @ 21:27
 * Project: Conţinut CMS
 */
namespace Extensions\System\Backend\Classes\Controllers {

	use Core\Mvc\Controller\BackendController;
	use Core\System\Storage\LocalStorage;
	use Core\Utility;

	class MediaController extends BackendController {

		public function __construct() {
			parent::__construct();
			$this->setLayoutTemplate(Utility::getResource("Default", "Backend", "Backend", "Layout"));
		}

		public function indexAction() {
			$storage = Utility::createInstance("\\Core\\System\\Storage\\LocalStorage");

			$path = $this->getRequest()->getArgument("path", "");

			$this->getView()->assign("path", $path);
			$this->getView()->assign("files", $storage->getFiles($path));
			$this->getView()->assign("folders", $storage->getFolders($path));
		}
	}

}
