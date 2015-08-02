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
	use Core\Utility;

	class MediaController extends BackendController {

		/**
		 * @var Core\System\Storage\StorageInterface
		 */
		protected $storage;

		public function __construct() {
			parent::__construct();
			$this->setLayoutTemplate(Utility::getResource("Default", "Backend", "Backend", "Layout"));

			$this->storage = Utility::createInstance("\\Core\\System\\Storage\\LocalStorage");
		}

		/**
		 * Index page
		 */
		public function indexAction() {

			$path = urldecode($this->getRequest()->getArgument("path", ""));

			$this->getView()->assign("path", $path);
			$this->getView()->assign("files", $this->storage->getFiles($path));
			$this->getView()->assign("folders", $this->storage->getFolders($path));
		}

		/**
		 * Create a folder
		 */
		public function createFolderAction() {
			$folder = $this->getRequest()->getArgument("folder");
			$path = urldecode($this->getRequest()->getArgument("path", ""));

			$createdFolder = $this->storage->createFolder($folder, $path);

			return json_encode(array("success" => $createdFolder));
		}

	}

}
