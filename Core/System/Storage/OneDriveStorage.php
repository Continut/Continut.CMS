<?php
/**
 * This file is part of the Conținut CMS project.
 * Distributed under the GNU General Public License.
 * For more details, consult the LICENSE.txt file supplied with the project
 * Author: Radu Mogoş <radu.mogos@pixelplant.ch>
 * Date: 01.08.2015 @ 13:41
 * Project: Conţinut CMS
 */

namespace Continut\Core\System\Storage;

use Continut\Core\Tools\Exception;
use Continut\Core\Utility;
use Krizalys\Onedrive\Client;

/**
 * Class LocalStorage
 *
 * Microsoft OneDrive file storage
 *
 * @package Continut\Core\System\Storage
 */
class OneDriveStorage implements StorageInterface
{
    /**
     * Get root directory of the storage
     *
     * @return string
     */
    public function getRoot()
    {
        return __ROOTCMS__;
    }

    /**
     * Return all files found inside a directory
     *
     * @param string $path
     *
     * @return array
     */
    public function getFiles($path = '')
    {
        if ($path === '') {
            $path = self::MEDIA_DIRECTORY;
        }

        $existingFiles = new \FilesystemIterator($this->getRoot() . $path);

        $fileObjects = array();

        foreach ($existingFiles as $existingFile) {
            try {
                if ($existingFile->getType() == 'file') {
                    $fileRelativePath = $path . DS . $existingFile->getFilename();

                    $fileObject = Utility::createInstance('Continut\Core\System\Storage\File');
                    $fileObject->setName($existingFile->getBasename('.' . $existingFile->getExtension()));
                    $fileObject->setExtension(strtoupper($existingFile->getExtension()));
                    $fileObject->setRelativePath($path);
                    $fileObject->setRelativeFilename($fileRelativePath);
                    $fileObject->setAbsolutePath($existingFile->getPath());
                    $fileObject->setAbsoluteFilename($existingFile->getPathname());
                    $fileObject->setFullname($existingFile->getFilename());
                    $fileObject->setSize($existingFile->getSize());
                    $fileObjects[] = $fileObject;
                }
            } catch (\RuntimeException $e) {
                // TODO: Add log message regarding an invalid file (probably the file name is in a different encoding)
                // and/or has special symbols
            }
        }

        return $fileObjects;
    }

    /**
     * Returns all folders inside $path
     *
     * @param string $path
     *
     * @return array
     */
    public function getFolders($path = '')
    {
        $folderObjects = [];

        try {
            if (!Utility::getSession()->has('onedrive.client.state')) {
                $oneDrive = new Client(array(
                    'client_id' => Utility::getConfiguration('OneDrive/Client/Id'),
                ));

                Utility::getSession()->set('onedrive.client.state', $oneDrive->getState());
            } else {
                $oneDrive = new Client(array(
                    'state' => Utility::getSession()->get('onedrive.client.state'),
                ));
            }
            if ($path === '') {
                $path = null;
            }

            $folder  = $oneDrive->fetchObject($path);
            $objects = $folder->fetchChildObjects();

            foreach ($objects as $object) {
                if ($object->isFolder()) {
                    $folderObject = Utility::createInstance('Continut\Core\System\Storage\Folder');

                    $folderObject->setName($object->getName());
                    $folderObject->setAbsolutePath($folder->getId() . ':' . $object->getName());
                    $folderObject->setRelativePath($folder->getId() . ':' . $object->getName());

                    // @TODO : Get actual values from OneDrive
                    $folderObject->setCountFolders(0);
                    $folderObject->setCountFiles(0);

                    // count files and folders inside this folder
                    /*$subfiles = new \FilesystemIterator($folderObject->getAbsolutePath(), \FilesystemIterator::SKIP_DOTS);
                    foreach ($subfiles as $sub) {
                        if ($sub->getType() == 'dir') {
                            $folderObject->setCountFolders($folderObject->getCountFolders() + 1);
                        } else {
                            $folderObject->setCountFiles($folderObject->getCountFiles() + 1);
                        }
                    }*/
                    $folderObjects[] = $folderObject;
                }
            }
        } catch (Exception $e) {

        }

        return $folderObjects;
    }

    /**
     * Attempts to create a directory
     *
     * @param string $folder Folder to create
     * @param string $path Inside which path?
     *
     * @return bool
     */
    public function createFolder($folder, $path)
    {
        if ($path == '') {
            $path = DS . self::MEDIA_DIRECTORY;
        }
        return mkdir($this->getRoot() . $path . DS . $folder);
    }

    /**
     * @param string $identifier
     *
     * @return \Continut\Core\System\Storage\File
     */
    public function getFileInfo($identifier) {
        $file = __ROOTCMS__ . str_replace('../', '', urldecode($identifier));

        $splFile = new \SplFileInfo($file);
        $fileObject = $this->setFileInfo($identifier, $splFile);

        return $fileObject;
    }

    /**
     * @param \SplFileInfo $splFile
     *
     * @return \Continut\Core\System\Storage\File
     */
    protected function setFileInfo($filename, $splFile) {
        $fileObject = Utility::createInstance('Continut\Core\System\Storage\File');

        $fileObject->setName($splFile->getBasename('.' . $splFile->getExtension()));
        $fileObject->setExtension(strtoupper($splFile->getExtension()));
        $fileObject->setRelativePath(str_replace(__ROOTCMS__, '', $splFile->getPath()));
        $fileObject->setRelativeFilename(str_replace(__ROOTCMS__, '', $splFile->getPathname()));
        $fileObject->setAbsolutePath($splFile->getPath());
        $fileObject->setAbsoluteFilename($splFile->getPathname());
        $fileObject->setFullname($splFile->getFilename());
        $fileObject->setSize($splFile->getSize());

        return $fileObject;
    }
}
