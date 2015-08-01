<?php
/**
 * This file is part of the Con?inut CMS project.
 * Distributed under the GNU General Public License.
 * For more details, consult the LICENSE.txt file supplied with the project
 * Author: Radu Mogoş <radu.mogos@pixelplant.ch>
 * Date: 01.08.2015 @ 13:41
 * Project: Conţinut CMS
 */
namespace Core\System\Storage {

	use Core\Utility;

	/**
	 * Class LocalStorage
	 *
	 * Local filesystem file storage
	 * It only deals with files and folders INSIDE "/Media/"
	 *
	 * @package Core\System\Storage
	 */
	class LocalStorage implements StorageInterface
	{

		const MEDIA_DIRECTORY = "Media";

		/**
		 * Get root directory of the storage
		 *
		 * @return string
		 */
		public function getRoot() {
			return __ROOTCMS__;
		}

		/**
		 * Return all files found inside a directory
		 *
		 * @param string $path
		 * @return array
		 */
		public function getFiles($path = "") {
			if ($path === "") {
				$path = DS . self::MEDIA_DIRECTORY;
			} else {
				$path = DS . self::MEDIA_DIRECTORY . DS . $path;
			}

			$existingFiles = new \FilesystemIterator($this->getRoot() . $path);

			$fileObjects = array();

			foreach ($existingFiles as $existingFile) {
				if ($existingFile->getType() == "file") {
					$fileRelativePath = $path . DS . $existingFile->getFilename();

					$fileObject = Utility::createInstance("\\Core\\System\\Storage\\File");
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
			}

			return $fileObjects;
		}

		/**
		 * Returns all folders inside $path
		 *
		 * @param string $path
		 * @return array
		 */
		public function getFolders($path = "") {
			if ($path === "") {
				$path = DS . self::MEDIA_DIRECTORY;
			} else {
				$path = DS . self::MEDIA_DIRECTORY . DS . $path;
			}

			$existingFolders = new \FilesystemIterator($this->getRoot() . $path);

			$folderObjects = array();

			foreach ($existingFolders as $existingFolder) {
				if ($existingFolder->getType() == "dir") {
					$folderObject = Utility::createInstance("\\Core\\System\\Storage\\Folder");

					$folderObject->setName($existingFolder->getFilename());
					$folderObject->setAbsolutePath($existingFolder->getPathname());
					$folderObject->setRelativePath($path . DS . $existingFolder);

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
			}

			return $folderObjects;
		}
	}

}
