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

    class File extends BaseModel
    {
        /**
         * @var string
         */
        protected $filename;

        /**
         * @var integer
         */
        protected $filesize;

        /**
         * @var string
         */
        protected $location;

        /**
         * @var string
         */
        protected $mime;

        /**
         * @var \DateTime
         */
        protected $created_at;

        /**
         * @var \DateTime
         */
        protected $modified_at;

        /**
         * Simple datamapper used for the database
         *
         * @return array
         */
        public function dataMapper()
        {
            return [
                "filename" => $this->filename,
                "filesize" => $this->filesize,
                "location" => $this->location,
                "mime" => $this->mine,
                "created_at" => $this->created_at,
                "modified_at" => $this->modified_at,
                "mount_id" => $this->mount_id
            ];
        }

        /**
         * @return string
         */
        public function getFilename()
        {
            return $this->filename;
        }

        /**
         * @param string $filename
         *
         * @return File
         */
        public function setFilename($filename)
        {
            $this->filename = $filename;

            return $this;
        }

        /**
         * @return int
         */
        public function getFilesize()
        {
            return $this->filesize;
        }

        /**
         * @param int $filesize
         *
         * @return File
         */
        public function setFilesize($filesize)
        {
            $this->filesize = $filesize;

            return $this;
        }

        /**
         * @return string
         */
        public function getLocation()
        {
            return $this->location;
        }

        /**
         * @param string $location
         *
         * @return File
         */
        public function setLocation($location)
        {
            $this->location = $location;

            return $this;
        }

        /**
         * Return the file's relative path
         *
         * @return string
         */
        public function getRelativePath()
        {
            return DS . $this->location . $this->filename;
        }

        /**
         * @return string
         */
        public function getMime()
        {
            return $this->mime;
        }

        /**
         * @param string $mime
         *
         * @return File
         */
        public function setMime($mime)
        {
            $this->mime = $mime;

            return $this;
        }

        /**
         * @return \DateTime
         */
        public function getCreatedAt()
        {
            return $this->created_at;
        }

        /**
         * @param \DateTime $created_at
         *
         * @return File
         */
        public function setCreatedAt($created_at)
        {
            $this->created_at = $created_at;

            return $this;
        }

        /**
         * @return \DateTime
         */
        public function getModifiedAt()
        {
            return $this->modified_at;
        }

        /**
         * @param \DateTime $modified_at
         *
         * @return File
         */
        public function setModifiedAt($modified_at)
        {
            $this->modified_at = $modified_at;

            return $this;
        }
    }
}