<?php
/**
 * This file is part of the Conţinut CMS project.
 * Distributed under the GNU General Public License.
 * For more details, consult the LICENSE.txt file supplied with the project
 * Author: Radu Mogoş <radu.mogos@pixelplant.ch>
 * Date: 20.04.2015 @ 21:27
 * Project: Conţinut CMS
 */
namespace Continut\Extensions\System\Backend\Classes\Controllers;

use Continut\Core\Mvc\Controller\BackendController;
use Continut\Core\System\Storage\LocalStorage;
use Continut\Core\Utility;

class MediaController extends BackendController
{
    /**
     * @var \Continut\Core\System\Storage\StorageInterface
     */
    protected $storage;

    public function __construct()
    {
        parent::__construct();
        $this->setLayoutTemplate(Utility::getResource('Default', 'Backend', 'Backend', 'Layout'));

        $this->storage = Utility::createInstance('Continut\Core\System\Storage\LocalStorage');
    }

    /**
     * Index page, by default shows the entry /Media folder with its files
     */
    public function indexAction()
    {
        $path = urldecode($this->getRequest()->getArgument('path', LocalStorage::MEDIA_DIRECTORY));

        $this->getView()->assignMultiple(
            [
                'path'    => $path,
                'files'   => $this->storage->getFiles($path),
                'folders' => $this->storage->getFolders($path)
            ]
        );
    }

    /**
     * Create a folder
     */
    public function createFolderAction()
    {
        $folder = $this->getRequest()->getArgument('folder');
        $path = urldecode($this->getRequest()->getArgument('path', ''));

        $createdFolder = $this->storage->createFolder($folder, $path);

        return json_encode(['success' => $createdFolder]);
    }

    /**
     * Show detailed information about a file
     */
    public function fileInfoAction() {
        $fileInfo = $this->storage->getFileInfo($this->getRequest()->getArgument('file'));

        $this->getView()->assign('fileInfo', $fileInfo);
    }
}
