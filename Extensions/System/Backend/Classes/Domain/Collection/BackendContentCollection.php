<?php
/**
 * This file is part of the Conţinut CMS project.
 * Distributed under the GNU General Public License.
 * For more details, consult the LICENSE.txt file supplied with the project
 * Author: Radu Mogoş <radu.mogos@pixelplant.ch>
 * Date: 04.04.2015 @ 13:02
 * Project: Conţinut CMS
 */
namespace Continut\Extensions\System\Backend\Classes\Domain\Collection;

use Continut\Core\System\Domain\Collection\ContentCollection;
use Continut\Core\Utility;

class BackendContentCollection extends ContentCollection
{
    /**
     * Set tablename and element class
     */
    public function __construct()
    {
        $this->_tablename = "sys_content";
        $this->_elementClass = 'Continut\Extensions\System\Backend\Classes\Domain\Model\BackendContent';
    }

    /**
     * Do a custom where on the collection and return different type objects
     *
     * @param $conditions
     * @param $values
     *
     * @return $this
     */
    public function where($conditions, $values = [])
    {
        $this->_elements = [];
        $sth = Utility::getDatabase()->prepare("SELECT * FROM $this->_tablename WHERE " . $conditions);
        $sth->execute($values);
        $sth->setFetchMode(\PDO::FETCH_ASSOC);
        while ($row = $sth->fetch()) {
            $element = $this->createEmptyFromType($row["type"]);
            $element->update($row);
            $this->add($element);
        }

        return $this;
    }

    /**
     * @param string $type Type of instance to create
     *
     * @return mixed
     */
    public function createEmptyFromType($type)
    {
        switch ($type) {
            case "plugin":
                $element = Utility::createInstance('Continut\Extensions\System\Backend\Classes\Domain\Model\Content\BackendPluginContent');
                break;
            case "container":
                $element = Utility::createInstance('Continut\Extensions\System\Backend\Classes\Domain\Model\Content\BackendContainerContent');
                break;
            case "reference":
                $element = Utility::createInstance('Continut\Extensions\System\Backend\Classes\Domain\Model\Content\BackendReferenceContent');
                break;
            default:
                $element = Utility::createInstance($this->_elementClass);
        }

        return $element;
    }
}
