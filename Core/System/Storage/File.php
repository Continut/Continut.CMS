<?php
/**
 * This file is part of the Con?inut CMS project.
 * Distributed under the GNU General Public License.
 * For more details, consult the LICENSE.txt file supplied with the project
 * Author: Radu Mogo? <radu.mogos@pixelplant.ch>
 * Date: 01.08.2015 @ 13:53
 * Project: Con?inut CMS
 */
namespace Core\System\Storage {

	class File
	{
		/**
		 * Filename without extension
		 *
		 * @var string
		 */
		protected $name;

		/**
		 * Filename with extension
		 *
		 * @var string
		 */
		protected $fullname;

		/**
		 * @var integer
		 */
		protected $size;

		/**
		 * @var string
		 */
		protected $extension;

		/**
		 * @var string
		 */
		protected $relativePath;

		/**
		 * @var string
		 */
		protected $relativeFilename;

		/**
		 * @var string
		 */
		protected $absolutePath;

		/**
		 * @var string
		 */
		protected $absoluteFilename;

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
		 * @return int
		 */
		public function getSize()
		{
			return $this->size;
		}

		/**
		 * @param int $size
		 */
		public function setSize($size)
		{
			$this->size = $size;
		}

		/**
		 * @return string
		 */
		public function getExtension()
		{
			return $this->extension;
		}

		/**
		 * @param string $extension
		 */
		public function setExtension($extension)
		{
			$this->extension = $extension;
		}

		/**
		 * @return string
		 */
		public function getFullname()
		{
			return $this->fullname;
		}

		/**
		 * @param string $fullname
		 */
		public function setFullname($fullname)
		{
			$this->fullname = $fullname;
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
		public function getRelativeFilename()
		{
			return $this->relativeFilename;
		}

		/**
		 * @param string $relativeFilename
		 */
		public function setRelativeFilename($relativeFilename)
		{
			$this->relativeFilename = $relativeFilename;
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
		 * @return string
		 */
		public function getAbsoluteFilename()
		{
			return $this->absoluteFilename;
		}

		/**
		 * @param string $absoluteFilename
		 */
		public function setAbsoluteFilename($absoluteFilename)
		{
			$this->absoluteFilename = $absoluteFilename;
		}
	}

}
