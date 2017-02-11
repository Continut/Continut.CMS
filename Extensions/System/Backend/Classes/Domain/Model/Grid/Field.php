<?php
/**
 * This file is part of the Conţinut CMS project.
 * Distributed under the GNU General Public License.
 * For more details, consult the LICENSE.txt file supplied with the project
 * Author: Radu Mogoş <radu.mogos@pixelplant.ch>
 * Date: 03.01.2016 @ 17:50
 * Project: Conţinut CMS
 */

namespace Continut\Extensions\System\Backend\Classes\Domain\Model\Grid;

use Continut\Core\Mvc\Model\BaseModel;
use Continut\Core\Utility;

class Field extends BaseModel
{
    /**
     * @var string Input's field name
     */
    protected $name;

    /**
     * @var mixed Input's value
     */
    protected $value;

    /**
     * @var string Css class to use for the field
     */
    protected $css;

    /**
     * @var string Label of the field
     */
    protected $label;

    /**
     * @var string
     */
    protected $filter;

    /**
     * @var \Continut\Extensions\System\Backend\Classes\View\Filter\BaseFilter
     */
    protected $filterObject;

    /**
     * @var string
     */
    protected $renderer;

    /**
     * @var \Continut\Extensions\System\Backend\Classes\View\Renderer\BaseRenderer
     */
    protected $rendererObject;

    /**
     * @return string
     */
    public function getCss()
    {
        return $this->css;
    }

    /**
     * @param $css
     *
     * @return $this
     */
    public function setCss($css)
    {
        $this->css = $css;

        return $this;
    }

    /**
     * @return string
     */
    public function getLabel()
    {
        return $this->label;
    }

    /**
     * @param $label
     *
     * @return $this
     */
    public function setLabel($label)
    {
        $this->label = $label;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getFilter()
    {
        return $this->filterObject;
    }

    /**
     * @param array $filter Configuration array for the filter
     *
     * @return $this
     * @throws \Continut\Core\Tools\ErrorException
     */
    public function setFilter($filter)
    {
        $this->filter = $filter;
        $this->filterObject = Utility::createInstance($filter["class"]);
        if (isset($filter["values"])) {
            $this->filterObject->setValues($filter["values"]);
        }
        $this->filterObject->setField($this);

        return $this;
    }

    /**
     * @return \Continut\Extensions\System\Backend\Classes\View\Renderer\BaseRenderer
     */
    public function getRenderer()
    {
        return $this->rendererObject;
    }

    /**
     * @param $renderer
     *
     * @return $this
     */
    public function setRenderer($renderer)
    {
        $this->renderer = $renderer;
        if (!isset($renderer['class'])) {
            $renderer['class'] = 'Continut\Extensions\System\Backend\Classes\View\Renderer\TextRenderer';
        }
        $this->rendererObject = Utility::createInstance($renderer['class']);
        if (isset($renderer['parameters'])) {
            $this->rendererObject->setParameters($renderer['parameters']);
        }
        $this->rendererObject->setField($this);

        return $this;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     *
     * @return $this
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param mixed $value
     *
     * @return $this
     */
    public function setValue($value)
    {
        $this->value = $value;

        return $this;
    }

    /**
     * Gets the column name of the field. Eg: usergroupId becomes usergroup_id
     * @return string
     */
    public function getDatabaseColumn() {
        return Utility::toUnderscore($this->name);
    }
}
