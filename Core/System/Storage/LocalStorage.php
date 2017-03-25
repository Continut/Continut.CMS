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

use Continut\Core\Utility;

/**
 * Class LocalStorage
 *
 * Local filesystem file storage
 * It only deals with files and folders INSIDE "/Media/"
 *
 * @package Continut\Core\System\Storage
 */
class LocalStorage implements StorageInterface
{

    const MEDIA_DIRECTORY = 'Media';

    /**
     * Get root directory of the storage
     *
     * @return string
     */
    public function getRoot()
    {
        return self::MEDIA_DIRECTORY;
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
        $existingFiles = new \FilesystemIterator(__ROOTCMS__ . DS . $path);

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
                    $fileObject->setCreationDate($existingFile->getCTime());
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
        $existingFolders = new \FilesystemIterator(__ROOTCMS__ . DS . $path);

        $folderObjects = array();

        foreach ($existingFolders as $existingFolder) {
            try {
                if ($existingFolder->getType() == 'dir') {
                    $folderObject = Utility::createInstance('Continut\Core\System\Storage\Folder');

                    $folderObject->setName($existingFolder->getFilename());
                    $folderObject->setAbsolutePath($existingFolder->getPathname());
                    $folderObject->setRelativePath($path . DS . $existingFolder->getFilename());

                    // count files and folders inside this folder
                    $subfiles = new \FilesystemIterator($folderObject->getAbsolutePath(), \FilesystemIterator::SKIP_DOTS);
                    foreach ($subfiles as $sub) {
                        if ($sub->getType() == 'dir') {
                            $folderObject->setCountFolders($folderObject->getCountFolders() + 1);
                        } else {
                            $folderObject->setCountFiles($folderObject->getCountFiles() + 1);
                        }
                    }
                    $folderObjects[] = $folderObject;
                }
            } catch (\RuntimeException $e) {
                // TODO: Add log message regarding an invalid folder (probably the folder name is in a different encoding)
            }
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
        return mkdir(__ROOTCMS__ . $path . DS . $folder);
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
        $fileObject->setCreationDate($splFile->getCTime());

        return $fileObject;
    }
}
