<?php
/**
 * This file is part of the Conţinut CMS project.
 * Distributed under the GNU General Public License.
 * For more details, consult the LICENSE.txt file supplied with the project
 * Author: Radu Mogoş <radu.mogos@pixelplant.ch>
 * Date: 08.08.2015 @ 15:11
 * Project: Conţinut CMS
 */

namespace Continut\Core\System\Domain\Collection;

use Continut\Core\Mvc\Model\BaseCollection;

class DomainUrlCollection extends BaseCollection
{
    /**
     * Set tablename and element class for this collection
     */
    public function __construct()
    {
        $this->tablename = 'sys_domain_urls';
        $this->elementClass = 'Continut\Core\System\Domain\Model\DomainUrl';
    }

    /**
     * @param bool   $addEmpty Should an initial empty value be added?
     * @param string $emptyTitle If so, what title should be shown, if any
     *
     * @return array
     */
    public function toSimplifiedArray($addEmpty = false, $emptyTitle = '')
    {
        $data = [];
        // Too much EU patriotism, I know. still waiting for a globe icon to replace it
        if ($addEmpty) {
            $data = [0 => ['title' => $emptyTitle, 'flag' => 'eu']];
        }
        foreach ($this->getAll() as $language) {
            $data[$language->getId()] = [
                'title' => $language->getTitle(),
                'flag'  => $language->getFlag()
            ];
        }
        return $data;
    }

    /**
     * Fetches all languages (domainUrls) for a certain domain
     *
     * @param int    $domainId
     * @oaram string $orderBy
     *
     * @return $this
     */
    public function whereDomain($domainId, $orderBy = 'sorting ASC')
    {
        return $this->where('domain_id = :domain_id ORDER BY :order_by', ['domain_id' => $domainId, 'order_by' => $orderBy]);
    }

    /**
     * Fetches the language specified by id and makes sure it also belongs to the right domain
     *
     * @param int $domainId
     * @param int $languageId
     *
     * @return $this
     */
    public function whereDomainAndLanguage($domainId, $languageId)
    {
        return $this->where(
            'domain_id = :domain_id AND id = :id ORDER BY sorting ASC',
            ['domain_id' => $domainId, 'id' => $languageId]
        );
    }
}
