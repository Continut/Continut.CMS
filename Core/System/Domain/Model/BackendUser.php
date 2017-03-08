<?php
/**
 * This file is part of the Conţinut CMS project.
 * Distributed under the GNU General Public License.
 * For more details, consult the LICENSE.txt file supplied with the project
 * Author: Radu Mogoş <radu.mogos@pixelplant.ch>
 * Date: 27.04.2015 @ 22:27
 * Project: Conţinut CMS
 */

namespace Continut\Core\System\Domain\Model;

use Continut\Core\Utility;

class BackendUser extends User
{
    /**
     * @var string Fullname of backend user
     */
    protected $name;

    /**
     * @var string Language for this backend user
     */
    protected $language;

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getLanguage()
    {
        return $this->language;
    }

    /**
     * @param string $language
     */
    public function setLanguage($language)
    {
        $this->language = $language;
    }

    /**
     * Simple datamapper used for the database
     *
     * @return array
     */
    public function dataMapper()
    {
        $fields = [
            'name'     => $this->name,
            'language' => $this->language
        ];

        return array_merge($fields, parent::dataMapper());
    }

    /**
     * Save FrontendUser data
     */
    public function save()
    {
        $collection = Utility::createInstance('Continut\Core\System\Domain\Collection\BackendUserCollection');
        $collection->add($this)->save();
    }
}
