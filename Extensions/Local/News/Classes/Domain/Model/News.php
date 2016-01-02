<?php
/**
 * This file is part of the Conţinut CMS project.
 * Distributed under the GNU General Public License.
 * For more details, consult the LICENSE.txt file supplied with the project

 * Author: Radu Mogoş <radu.mogos@pixelplant.ch>
 * Date: 02.01.2016 @ 17:57
 * Project: Conţinut CMS
 */
namespace Extensions\Local\News\Classes\Domain\Model {

	use Core\Mvc\Model\BaseModel;
	use Core\Mvc\Model\Content;

	class News extends BaseModel {

		/**
		 * @var string
		 */
		protected $title;

		/**
		 * @var string
		 */
		protected $description;

		/**
		 * @var bool
		 */
		protected $is_visible;

		/**
		 * @var int
		 */
		protected $author;

		/**
		 * Simple datamapper used for the database
		 * @return array
		 */
		public function dataMapper() {
			return [
				"uid"         => $this->uid,
				"title"       => $this->title,
				"description" => $this->description,
				"is_visible"  => $this->is_visible,
				"author"      => $this->author
			];
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
		 */
		public function setTitle($title)
		{
			$this->title = $title;
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
		 */
		public function setIsVisible($is_visible)
		{
			$this->is_visible = $is_visible;
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
		 */
		public function setDescription($description)
		{
			$this->description = $description;
		}

		/**
		 * @return int
		 */
		public function getAuthor()
		{
			return $this->author;
		}

		/**
		 * @param int $author
		 */
		public function setAuthor($author)
		{
			$this->author = $author;
		}

	}

}
