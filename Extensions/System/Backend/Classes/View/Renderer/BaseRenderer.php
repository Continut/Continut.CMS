<?php
/**
 * This file is part of the Conţinut CMS project.
 * Distributed under the GNU General Public License.
 * For more details, consult the LICENSE.txt file supplied with the project
 * Author: Radu Mogoş <radu.mogos@pixelplant.ch>
 * Date: 02.01.2016 @ 16:33
 * Project: Conţinut CMS
 */
namespace Continut\Extensions\System\Backend\Classes\View\Renderer;

use Continut\Core\Mvc\View\BaseView;

class BaseRenderer extends BaseView
{
    /**
     * @var \Continut\Extensions\System\Backend\Classes\Domain\Model\Grid\Field
     */
    protected $field;

    /**
     * @var array Parameters to be sent to the renderer template
     */
    protected $parameters;

    /**
     * The record that this renderer will show
     *
     * @var \Continut\Core\Mvc\Model\BaseModel\BaseModel
     */
    protected $record;

    /**
     * @return \Continut\Extensions\System\Backend\Classes\Domain\Model\Grid\Field
     */
    public function getField()
    {
        return $this->field;
    }

    /**
     * @param \Continut\Extensions\System\Backend\Classes\Domain\Model\Grid\Field $field
     *
     * @return $this
     */
    public function setField($field)
    {
        $this->field = $field;

        return $this;
    }

    /**
     * @return array
     */
    public function getParameters()
    {
        return $this->parameters;
    }

    /**
     * @param $parameters
     *
     * @return $this
     */
    public function setParameters($parameters)
    {
        $this->parameters = $parameters;

        return $this;
    }

    /**
     * @param string $parameter
     *
     * @return mixed|null
     */
    public function getParameter($parameter) {
        if (isset($this->parameters[$parameter])) {
            return $this->parameters[$parameter];
        }

        return null;
    }

    /**
     * @return \Continut\Core\Mvc\Model\BaseModel
     */
    public function getRecord()
    {
        return $this->record;
    }

    /**
     * @param $record
     *
     * @return $this
     */
    public function setRecord($record)
    {
        $this->record = $record;

        return $this;
    }
}
