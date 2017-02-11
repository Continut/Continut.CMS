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

class Route extends BaseModel
{
    /**
     * @var string Route name
     */
    protected $name;

    /**
     * @var string Route path
     */
    protected $path;

    /**
     * @var array Route data
     */
    protected $data;

    /**
     * Simple data mapper used for the database
     *
     * @return array
     */
    public function dataMapper()
    {
        $fields = [
            "name" => $this->name,
            "path" => $this->path,
            "data" => $this->data
        ];
        return array_merge($fields, parent::dataMapper());
    }

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
    public function getPath()
    {
        return $this->path;
    }

    /**
     * @param string $path
     */
    public function setPath($path)
    {
        $this->path = $path;
    }

    /**
     * @return array
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * @param array $data
     */
    public function setData($data)
    {
        $this->data = $data;
    }
}
