<?php
/**
 * This file is part of the Conţinut CMS project.
 * Distributed under the GNU General Public License.
 * For more details, consult the LICENSE.txt file supplied with the project
 * Author: Radu Mogoş <radu.mogos@pixelplant.ch>
 * Date: 07.04.2015 @ 22:46
 * Project: Conţinut CMS
 */

namespace Continut\Core\System\Domain\Model;

use Continut\Core\Mvc\Model\BaseModel;
use Continut\Core\Utility;

class Domain extends BaseModel
{
    /**
     * @var string
     */
    protected $title;

    /**
     * @var bool
     */
    protected $isVisible;

    /**
     * @var int
     */
    protected $sorting;

    /**
     * @var array
     */
    protected $domainUrls;

    /**
     * Simple datamapper used for the database
     *
     * @return array
     */
    public function dataMapper()
    {
        $fields = [
            "title"      => $this->title,
            "is_visible" => $this->isVisible,
            "sorting"    => $this->sorting
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
     * @param $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @return bool
     */
    public function isIsVisible()
    {
        return $this->isVisible;
    }

    /**
     * @param bool $isVisible
     */
    public function setIsVisible($isVisible)
    {
        $this->isVisible = $isVisible;
    }

    /**
     * @return int
     */
    public function getSorting()
    {
        return $this->sorting;
    }

    /**
     * @param int $sorting
     */
    public function setSorting($sorting)
    {
        $this->sorting = $sorting;
    }

    /**
     * @return array
     * @throws \Continut\Core\Tools\Exception
     */
    public function getDomainUrls()
    {
        if ($this->domainUrls == null) {
            $this->domainUrls = Utility::createInstance('Continut\Core\System\Domain\Collection\DomainUrlCollection')->findByDomainId($this->id);
        }
        return $this->domainUrls;
    }
}
