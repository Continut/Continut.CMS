<?php
/**
 * This file is part of the Con?inut CMS project.
 * Distributed under the GNU General Public License.
 * For more details, consult the LICENSE.txt file supplied with the project
 * Author: Radu Mogo? <radu.mogos@pixelplant.ch>
 * Date: 01.08.2015 @ 14:54
 * Project: Con?inut CMS
 */
namespace Core\System\Storage {

	class Folder
	{
		/**
		 * @var string
		 */
		protected $name;

		/**
		 * @var string
		 */
		protected $relativePath;

		/**
		 * @var string
		 */
		protected $absolutePath;

		/**
		 * @var int
		 */
		protected $countFiles = 0;

		/**
		 * @var int
		 */
		protected $countFolders = 0;

		/**
		 * @return string
		 */
		public function getName()
		{
			return $this->name;
		}

		/**
		 * @param string $name
		 */
		public function setName($name)
		{
			$this->name = $name;
		}

		/**
		 * @return string
		 */
		public function getRelativePath()
		{
			return $this->relativePath;
		}

		/**
		 * @param string $relativePath
		 */
		public function setRelativePath($relativePath)
		{
			$this->relativePath = $relativePath;
		}

		/**
		 * @return string
		 */
		public function getAbsolutePath()
		{
			return $this->absolutePath;
		}

		/**
		 * @param string $absolutePath
		 */
		public function setAbsolutePath($absolutePath)
		{
			$this->absolutePath = $absolutePath;
		}

		/**
		 * @return int
		 */
		public function getCountFiles()
		{
			return $this->countFiles;
		}

		/**
		 * @param int $countFiles
		 */
		public function setCountFiles($countFiles)
		{
			$this->countFiles = $countFiles;
		}

		/**
		 * @return int
		 */
		public function getCountFolders()
		{
			return $this->countFolders;
		}

		/**
		 * @param int $countFolders
		 */
		public function setCountFolders($countFolders)
		{
			$this->countFolders = $countFolders;
		}
	}

}
