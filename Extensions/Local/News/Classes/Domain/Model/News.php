<?php
/**
 * This file is part of the Conţinut CMS project.
 * Distributed under the GNU General Public License.
 * For more details, consult the LICENSE.txt file supplied with the project

 * Author: Radu Mogoş <radu.mogos@pixelplant.ch>
 * Date: 02.01.2016 @ 17:57
 * Project: Conţinut CMS
 */
namespace Continut\Extensions\Local\News\Classes\Domain\Model {

	use Continut\Core\Mvc\Model\BaseModel;

	/**
	 * Class News
	 *
	 * @package Continut\Extensions\Local\News\Classes\Domain\Model
	 * @Entity(repositoryClass="Continut\Extensions\Local\News\Classes\Domain\Collection\NewsCollection")
	 * @Table(name="ext_news")
	 */
	class News extends BaseModel {

		/**
		 * @var string
		 *
		 * @Column(name="title", type="string")
		 */
		protected $title;

		/**
		 * @var string
		 *
		 * @Column(name="description", type="text")
		 */
		protected $description;

		/**
		 * @var bool
		 *
		 * @Column(name="is_visible", type="boolean")
		 */
		protected $isVisible;

		/**
		 * @var int
		 *
		 * @Column(name="author", type="string")
		 */
		protected $author;

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
		 * @return News
		 */
		public function setTitle($title)
		{
			$this->title = $title;

			return $this;
		}

		/**
		 * @return boolean
		 */
		public function getIsVisible()
		{
			return $this->isVisible;
		}

		/**
		 * @param boolean $isVisible
		 *
		 * @return News
		 */
		public function setIsVisible($isVisible)
		{
			$this->isVisible = $isVisible;

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
		 * @return News
		 */
		public function setDescription($description)
		{
			$this->description = $description;

			return $this;
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
		 *
		 * @return News
		 */
		public function setAuthor($author)
		{
			$this->author = $author;

			return $this;
		}

	}

}
