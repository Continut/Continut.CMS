<?php
/**
 * This file is part of the Conţinut CMS project.
 * Distributed under the GNU General Public License.
 * For more details, consult the LICENSE.txt file supplied with the project
 * Author: Radu Mogoş <radu.mogos@pixelplant.ch>
 * Date: 02.01.2016 @ 17:57
 * Project: Conţinut CMS
 */
namespace Continut\Extensions\Local\News\Classes\Domain\Model;

use Continut\Core\Mvc\Model\BaseModel;
use Continut\Core\Utility;

class News extends BaseModel
{
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
    protected $isVisible;

    /**
     * @var int
     */
    protected $author;

    /**
     * @var \Continut\Core\System\Domain\Model\File[]
     */
    protected $images;

    /**
     * If you want to prevent loading the collection after each getImages call, then cache it
     *
     * @var bool
     */
    private $imagesLoaded = false;

    /**
     * Simple datamapper used for the database
     *
     * @return array
     */
    public function dataMapper()
    {
        $fields = [
            "title"       => $this->title,
            "description" => $this->description,
            "is_visible"  => $this->isVisible,
            "author"      => $this->author
        ];

        return array_merge($fields, parent::dataMapper());
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

    /**
     * @return \Continut\Core\System\Domain\Model\FileReference[]
     */
    public function getImages()
    {
        if (!$this->imagesLoaded) {
            $this->images = Utility::createInstance('Continut\Core\System\Domain\Collection\FileCollection')->sql('SELECT * FROM sys_files LEFT JOIN sys_file_references ON sys_files.id=sys_file_references.file_id WHERE sys_file_references.tablename=:tablename AND sys_file_references.foreign_id=:id AND sys_file_references.is_deleted=0 AND sys_file_references.is_visible=1', ['tablename' => 'ext_news', 'id' => $this->id]);
            $this->imagesLoaded = true;
        }
        return $this->images;
    }

    /**
     * @param \Continut\Core\System\Domain\Model\FileReference[] $images
     */
    public function setImages($images)
    {
        $this->images = $images;
    }

}
