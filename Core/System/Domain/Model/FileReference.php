<?php
/**
 * This file is part of the Conţinut CMS project.
 * Distributed under the GNU General Public License.
 * For more details, consult the LICENSE.txt file supplied with the project

 * Author: Radu Mogoş <radu.mogos@pixelplant.ch>
 * Date: 17.01.2016 @ 12:40
 * Project: Conţinut CMS
 */

namespace Continut\Core\System\Domain\Model {

	use Continut\Core\Mvc\Model\BaseModel;

	class FileReference extends BaseModel
	{
		/**
		 * @var integer
		 */
		protected $file_id;

		/**
		 * @var boolean
		 */
		protected $is_visible;

		/**
		 * @var boolean
		 */
		protected $is_deleted;

		/**
		 * @var string
		 */
		protected $tablename;

		/**
		 * @var string
		 */
		protected $title;

		/**
		 * @var string
		 */
		protected $alt;

		/**
		 * @var string
		 */
		protected $description;

		/**
		 * Simple datamapper used for the database
		 * @return array
		 */
		public function dataMapper() {
			return [
				"file_id"           => $this->file_id,
				"foreign_id"        => $this->foreign_id,
				"is_visible"        => $this->is_visible,
				"is_deleted"        => $this->is_deleted,
				"tablename"         => $this->tablename,
				"title"             => $this->title,
				"alt"               => $this->alt,
				"description"       => $this->description
			];
		}

		/**
		 * @return int
		 */
		public function getFileId()
		{
			return $this->file_id;
		}

		/**
		 * @param int $file_id
		 */
		public function setFileId($file_id)
		{
			$this->file_id = $file_id;
		}

		/**
		 * @return boolean
		 */
		public function getIsVisible()
		{
			return $this->is_visible;
		}

		/**
		 * @param boolean $is_visible
		 *
		 * @return FileReference
		 */
		public function setIsVisible($is_visible)
		{
			$this->is_visible = $is_visible;

			return $this;
		}

		/**
		 * @return boolean
		 */
		public function getIsDeleted()
		{
			return $this->is_deleted;
		}

		/**
		 * @param boolean $is_deleted
		 *
		 * @return FileReference
		 */
		public function setIsDeleted($is_deleted)
		{
			$this->is_deleted = $is_deleted;

			return $this;
		}

		/**
		 * @return string
		 */
		public function getTablename()
		{
			return $this->tablename;
		}

		/**
		 * @param string $tablename
		 *
		 * @return FileReference
		 */
		public function setTablename($tablename)
		{
			$this->tablename = $tablename;

			return $this;
		}

		/**
		 * @return string
		 */
		public function getTitle()
		{
			return $this->title;
		}

		/**
		 * @param string $title
		 *
		 * @return FileReference
		 */
		public function setTitle($title)
		{
			$this->title = $title;

			return $this;
		}

		/**
		 * @return string
		 */
		public function getAlt()
		{
			return $this->alt;
		}

		/**
		 * @param string $alt
		 *
		 * @return FileReference
		 */
		public function setAlt($alt)
		{
			$this->alt = $alt;

			return $this;
		}

		/**
		 * @return string
		 */
		public function getDescription()
		{
			return $this->description;
		}

		/**
		 * @param string $description
		 *
		 * @return FileReference
		 */
		public function setDescription($description)
		{
			$this->description = $description;

			return $this;
		}

	}
}