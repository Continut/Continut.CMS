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
    // default display mode, allows the browsing of files but no selection
    const HANDLING_TYPE_DISPLAY = 'display';

    // usually displayed in a popup, allows the browsing AND the select/multiselect of files
    const HANDLING_TYPE_SELECT = 'select';

    // Do we show files in square blocks similar to Windows Explorer's Thumbnail mode?
    const LIST_TYPE_THUMBNAILS = 'thumbnails';

    // or more like Explorer's List mode?
    const LIST_TYPE_LIST = 'list';

    /**
     * @var \Continut\Core\System\Storage\StorageInterface
     */
    protected $storage;

    /**
     * Should the files list be displayed in 'thumbnails' mode, or 'list' mode?
     *
     * @var string
     */
    protected $listType;

    /**
     * Are we just displaying the files or are we also able to select files (in a popup)
     * Possible values ('display' or 'select')
     *
     * @var string
     */
    protected $handlingType = self::HANDLING_TYPE_DISPLAY;

    public function __construct()
    {
        parent::__construct();
        $this->setLayoutTemplate(Utility::getResource('Default', 'Backend', 'Backend', 'Layout'));

        $this->listType     = $this->getUser()->getAttribute('media.list', self::LIST_TYPE_LIST);
        $this->handlingType = self::HANDLING_TYPE_SELECT;
        $this->storage      = Utility::createInstance('Continut\Core\System\Storage\LocalStorage');
    }

    /**
     * Index page, by default shows the entry /Media folder with its files
     */
    public function indexAction()
    {
        $path = urldecode($this->getRequest()->getArgument('path', $this->storage->getRoot()));

        $this->getFileObjects($path);
    }

    /**
     * Returns the list of files from the selected path, once a folder is clicked on in the Folder Tree
     */
    public function getFilesAction()
    {
        $path = urldecode($this->getRequest()->getArgument('path', $this->storage->getRoot()));

        $this->getFileObjects($path);
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
    public function fileInfoAction()
    {
        $fileInfo = $this->storage->getFileInfo($this->getRequest()->getArgument('file'));

        $this->getView()->assign('fileInfo', $fileInfo);
    }

    /**
     * @return string
     */
    public function treeGetNodeAction()
    {
        $path = $this->getRequest()->getArgument('id');
        $path = ($path == '#') ? $this->storage->getRoot() : $path;

        $jsonNodes = [];

        // get list of folders
        foreach ($this->storage->getFolders($path) as $folder) {
            $jsonNodes[] = [
                'text'     => $folder->getName(),
                'id'       => $folder->getRelativePath(),
                'children' => ($folder->getCountFolders() > 0),
                'icon'     => 'fa fa-folder'
            ];
        }

        // add root element to the filebrowser
        if ($path == $this->storage->getRoot()) {
            $jsonNodes = [['text' => $this->storage->getRoot(), 'children' => $jsonNodes, 'id' => $this->storage->getRoot(), 'icon' => 'fa fa-folder', 'state' => array('opened' => true)]];
        }

        return json_encode($jsonNodes);
    }

    /**
     * Returns all files found inside a path
     *
     * @var string $path
     *
     * @return void
     */
    protected function getFileObjects($path)
    {
        // @TODO: Check if it is worth indexing them while in browse mode or if we should only index them while selected
        // We also need to index these files in the sys_files table, if they are not indexed already
        //$fileCollection = Utility::createInstance('Continut\Core\System\Domain\Collection\FileCollection');
        //$fileCollection->where('location LIKE ":location"', ['location' => $path]);

        $this->getView()->assignMultiple(
            [
                'path'         => $path,
                'files'        => $this->storage->getFiles($path),
                'folders'      => $this->storage->getFolders($path),
                'listType'     => $this->listType,
                'handlingType' => $this->handlingType
            ]
        );
    }
}
