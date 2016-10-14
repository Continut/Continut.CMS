<?php
/**
 * This file is part of the Conţinut CMS project.
 * Distributed under the GNU General Public License.
 * For more details, consult the LICENSE.txt file supplied with the project
 * Author: Radu Mogoş <radu.mogos@pixelplant.ch>
 * Date: 08.08.2015 @ 16:25
 * Project: Conţinut CMS
 */
namespace Continut\Core\System\Domain\Model;

class Site
{
    /**
     * @var \Continut\Core\System\Domain\Model\DomainUrl
     */
    protected $domainUrl;

    /**
     * @return string
     */
    public function getUrl()
    {
        return $this->domainUrl->getUrl();
    }

    /**
     * @return \Continut\Core\System\Domain\Model\DomainUrl
     */
    public function getDomainUrl()
    {
        return $this->domainUrl;
    }

    /**
     * @param \Continut\Core\System\Domain\Model\DomainUrl $domainUrl
     *
     * @return $this
     */
    public function setDomainUrl($domainUrl)
    {
        $this->domainUrl = $domainUrl;
        return $this;
    }

    /**
     * @return \Continut\Core\System\Domain\Model\Domain
     */
    public function getDomain()
    {
        return $this->domainUrl->getDomain();
    }
}
