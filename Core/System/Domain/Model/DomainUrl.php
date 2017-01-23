<?php
/**
 * This file is part of the Conţinut CMS project.
 * Distributed under the GNU General Public License.
 * For more details, consult the LICENSE.txt file supplied with the project
 * Author: Radu Mogoş <radu.mogos@pixelplant.ch>
 * Date: 08.08.2015 @ 14:58
 * Project: Conţinut CMS
 */
namespace Continut\Core\System\Domain\Model;

use Continut\Core\Mvc\Model\BaseModel;
use Continut\Core\Utility;
use Respect\Validation\Validator as v;

class DomainUrl extends BaseModel
{
    /**
     * @var boolean
     */
    protected $isAlias;

    /**
     * @var int
     */
    protected $parentId;

    /**
     * @var string
     */
    protected $code;

    /**
     * @var int
     */
    protected $domainId;

    /**
     * @var string
     */
    protected $url;

    /**
     * @var int
     */
    protected $sorting;

    /**
     * @var string ISO2 code used for the flag
     */
    protected $flag;

    /**
     * @var string Locale used by this domain url
     */
    protected $locale;

    /**
     * @var \Continut\Core\System\Domain\Model\Domain
     */
    protected $domain = NULL;

    /**
     * @var string
     */
    protected $title;

    /**
     * Simple datamapper used for the database
     *
     * @return array
     */
    public function dataMapper()
    {
        $fields = [
            "is_alias"  => $this->isAlias,
            "parent_id" => $this->parentId,
            "domain_id" => $this->domainId,
            "sorting"   => $this->sorting,
            "locale"    => $this->locale,
            "flag"      => $this->flag,
            "url"       => $this->url,
            "title"     => $this->title,
            "code"      => $this->code
        ];
        return array_merge($fields, parent::dataMapper());
    }

    /**
     * Validation rules for the data
     *
     * @return array
     */
    public function dataValidation()
    {
        return [
            "title"  => v::length(3, 200),
            "url"    => v::noWhitespace()->length(1, 200),
            "locale" => v::noWhitespace()->length(2, 40)
        ];
        //return parent::dataValidation();
    }

    /**
     * @return boolean
     */
    public function getIsAlias()
    {
        return $this->isAlias;
    }

    /**
     * @param boolean $isAlias
     */
    public function setIsAlias($isAlias)
    {
        $this->isAlias = $isAlias;
    }

    /**
     * @return int
     */
    public function getParentId()
    {
        return $this->parentId;
    }

    /**
     * @param int $parentId
     */
    public function setParentId($parentId)
    {
        $this->parentId = $parentId;
    }

    /**
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @param string $url
     */
    public function setUrl($url)
    {
        $this->url = $url;
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
     * @return string
     */
    public function getFlag()
    {
        return $this->flag;
    }

    /**
     * @param string $flag
     */
    public function setFlag($flag)
    {
        $this->flag = $flag;
    }

    /**
     * @return string
     */
    public function getLocale()
    {
        return $this->locale;
    }

    /**
     * @param string $locale
     */
    public function setLocale($locale)
    {
        $this->locale = $locale;
    }

    /**
     * @return int
     */
    public function getDomainId()
    {
        return $this->domainId;
    }

    /**
     * @param int $domainId
     */
    public function setDomainId($domainId)
    {
        $this->domainId = $domainId;
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
     * @return \Continut\Core\System\Domain\Model\Domain
     * @throws \Continut\Core\Tools\Exception
     */
    public function getDomain()
    {
        if ($this->domain == null) {
            $this->domain = Utility::createInstance('Continut\Core\System\Domain\Collection\DomainCollection')->findById($this->domainId);
        }
        return $this->domain;
    }

    /**
     * @return string
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * @param string $code
     */
    public function setCode($code)
    {
        $this->code = $code;
    }

}
