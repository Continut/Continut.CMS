<?php
/**
 * This file is part of the Con?inut CMS project.
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

    const MEDIA_DIRECTORY = "Media";

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
    public function getFiles($path = "")
    {
        if ($path === "") {
            $path = DS . self::MEDIA_DIRECTORY;
        }

        $existingFiles = new \FilesystemIterator($this->getRoot() . $path);

        $fileObjects = array();

        foreach ($existingFiles as $existingFile) {
            try {
                if ($existingFile->getType() == "file") {
                    $fileRelativePath = $path . DS . $existingFile->getFilename();

                    $fileObject = Utility::createInstance('Continut\Core\System\Storage\File');
                    $fileObject->setName($existingFile->getBasename("." . $existingFile->getExtension()));
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
    public function getFolders($path = "")
    {
        if ($path === "") {
            $path = DS . self::MEDIA_DIRECTORY;
        }

        $existingFolders = new \FilesystemIterator($this->getRoot() . $path);

        $folderObjects = array();

        foreach ($existingFolders as $existingFolder) {
            try {
                if ($existingFolder->getType() == "dir") {
                    $folderObject = Utility::createInstance('Continut\Core\System\Storage\Folder');

                    $folderObject->setName($existingFolder->getFilename());
                    $folderObject->setAbsolutePath($existingFolder->getPathname());
                    $folderObject->setRelativePath($path . DS . $existingFolder->getFilename());

                    // count files and folders inside this folder
                    $subfiles = new \FilesystemIterator($folderObject->getAbsolutePath(), \FilesystemIterator::SKIP_DOTS);
                    foreach ($subfiles as $sub) {
                        if ($sub->getType() == "dir") {
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
        if ($path == "") {
            $path = DS . self::MEDIA_DIRECTORY;
        }
        return mkdir($this->getRoot() . $path . DS . $folder);
    }
}
