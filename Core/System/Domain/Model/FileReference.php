<?php
/**
 * This file is part of the Conţinut CMS project.
 * Distributed under the GNU General Public License.
 * For more details, consult the LICENSE.txt file supplied with the project
 * Author: Radu Mogoş <radu.mogos@pixelplant.ch>
 * Date: 17.01.2016 @ 12:40
 * Project: Conţinut CMS
 */

namespace Continut\Core\System\Domain\Model;

use Continut\Core\Mvc\Model\BaseModel;
use Continut\Core\Utility;

class FileReference extends BaseModel
{
    /**
     * @var int
     */
    protected $fileId;

    /**
     * @var bool
     */
    protected $isVisible;

    /**
     * @var bool
     */
    protected $isDeleted;

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
     * @var int
     */
    protected $foreignId;

    /**
     * Simple datamapper used for the database
     *
     * @return array
     */
    public function dataMapper()
    {
        $fields = [
            'file_id'     => $this->fileId,
            'foreign_id'  => $this->foreignId,
            'is_visible'  => $this->isVisible,
            'is_deleted'  => $this->isDeleted,
            'tablename'   => $this->tablename,
            'title'       => $this->title,
            'alt'         => $this->alt,
            'description' => $this->description
        ];

        return array_merge($fields, parent::dataMapper());
    }

    /**
     * @return int
     */
    public function getFileId()
    {
        return $this->fileId;
    }

    /**
     * @param int $fileId
     */
    public function setFileId($fileId)
    {
        $this->fileId = $fileId;
    }

    /**
     * @return bool
     */
    public function getIsVisible()
    {
        return $this->isVisible;
    }

    /**
     * @param bool $isVisible
     *
     * @return FileReference
     */
    public function setIsVisible($isVisible)
    {
        $this->isVisible = $isVisible;

        return $this;
    }

    /**
     * @return bool
     */
    public function getIsDeleted()
    {
        return $this->isDeleted;
    }

    /**
     * @param bool $isDeleted
     *
     * @return FileReference
     */
    public function setIsDeleted($isDeleted)
    {
        $this->isDeleted = $isDeleted;

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

    /**
     * Returns the original File that this reference points to (the record from sys_files)
     *
     * @return \Continut\Core\System\Domain\Model\File
     */
    public function getFile()
    {
        $fileCollection = Utility::createInstance('Continut\Core\System\Domain\Collection\FileCollection');
        return $fileCollection->findById($this->getFileId());
    }

}
