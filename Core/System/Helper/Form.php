<?php
/**
 * This file is part of the Conţinut CMS project.
 * Distributed under the GNU General Public License.
 * For more details, consult the LICENSE.txt file supplied with the project
 * Author: Radu Mogoş <radu.mogos@pixelplant.ch>
 * Date: 17.05.2015 @ 10:31
 * Project: Conţinut CMS
 */

namespace Continut\Core\System\Helper;

use Continut\Core\Mvc\Model\BaseModel;
use Continut\Core\Utility;

/**
 * Class Form
 *
 * The Form class is a helper class that can be used to generate different form elements for
 * your form, whenever your inputs are NOT linked to a model/BaseModel instance
 *
 * If you need to link them to a model and have automatic validation/error messages displayed, use
 * the FormObject helper instead
 *
 * @package Continut\Core\System\Helpers
 */
class Form
{
    /**
     * @var string Field prefix used in the backend form
     */
    protected $prefix = 'data';

    /**
     * Sets up the input's name accordingly
     *
     * @param string $name Name of the input
     * @return string Formatted name of the input, with prefix and optional square brackets
     */
    protected function setFieldName($name)
    {
        // you can also pass config keys as input names, in which case the slash needs to be replaced
        $name = str_replace('/', '_', $name);
        $fieldName = $this->prefix . "[$name]";
        // if the field name contains a square bracket, it means it's an array
        // so we need to set it up accordingly
        if (strpos($name, '[')) {
            // extract only the field name
            $name = substr($name, 0, strpos($name, '['));
            $fieldName = $this->prefix . '[$name][]';
        }
        return $fieldName;
    }

    /**
     * Sets the id attribute of the input
     *
     * @param string $name
     * @return string
     */
    protected function setFieldId($name) {
        return 'field_' . str_replace('/', '_', strtolower($name));
    }

    /**
     * Set the <label> tag
     * @param string $name
     * @param string $label
     * @return string
     */
    protected function setFieldLabel($name, $label)
    {
        if ($label) {
            // we do not set the id if the field $name is an array
            if (strpos($name, '[')) {
                return "<label class=\"control-label\">$label</label>";
            } else {
                return "<label class=\"control-label\" for='field_$name'>$label</label>";
            }
        }
        return '';
    }

    /**
     * Set the error messages and error classes on the wrapping divs
     *
     * @param BaseModel $model
     * @param string $columnName
     *
     * @return array Returns the error block with the messages and the error css class to use
     */
    protected function setErrors($model, $columnName)
    {
        $errorsClass = '';
        $errorsBlock = '';

        if ($model->hasValidationErrors($columnName)) {
            $errorsClass   = 'has-error';
            $errorMessages = '';
            foreach ($model->getValidationErrors($columnName) as $error) {
                $errorMessages .= '<p>$error</p>';
            }
            $errorsBlock = <<<HER
                <span class="help-block">$errorMessages</span>
HER;
        }

        return ['errorsBlock' => $errorsBlock, 'errorsClass' => $errorsClass];
    }

    /**
     * Wizard helper used to generate a hidden input
     *
     * @param string $name
     * @param string $value
     *
     * @return string
     */
    public function hiddenField($name, $value)
    {
        $fieldName = $this->setFieldName($name);
        $fieldId   = $this->setFieldId($name);

        $view = Utility::createInstance('Continut\Core\Mvc\View\BaseView');
        $view->setTemplate(Utility::getResourcePath('Form/hiddenField', 'Backend', 'Backend', 'Helper'));

        $view->assignMultiple(
            [
                'name'       => $name,
                'value'      => $value,
                'fieldName'  => $fieldName,
                'fieldId'    => $fieldId
            ]
        );

        return $view->render();
    }

    /**
     * Wizard helper used to generate a checkbox field
     *
     * @param string $name Input name
     * @param string $label Input label
     * @param mixed $values One value or array if you need to create a checkbox group
     * @param mixed $selectedValue Selected value by default
     *
     * @return string
     */
    public function checkboxField($name, $label, $values, $selectedValue = null)
    {
        $fieldName  = $this->setFieldName($name);
        $fieldId    = $this->setFieldId($name);
        $fieldLabel = $this->setFieldLabel($name, $label);

        $html = '';
        if (is_array($values)) {
            $fieldName = $fieldName . '[]';
            foreach ($values as $text => $value) {
                $id = $fieldId . '_' . $value;
                $html .= <<<HER
                    <input id="$id" type="text" value="$value" name="$fieldName"/> $text
HER;
            }
        } else {
            $html = <<<HER
                <div class="checkbox">
                $fieldLabel
                <input id="$fieldId" class="form-control" type="checkbox" value="$selectedValue" name="$fieldName"/>
                </div>
HER;
        }
        return $html;
    }

    /**
     * Shows a simple DateTime field with a label in a wizard
     *
     * @param string $name Input name
     * @param string $label Input label
     * @param string $value Default value
     *
     * @return string
     */
    public function dateTimeField($name, $label, $value = '')
    {
        $fieldName  = $this->setFieldName($name);
        $fieldId    = $this->setFieldId($name);
        $fieldLabel = $this->setFieldLabel($name, $label);

        $view = Utility::createInstance('Continut\Core\Mvc\View\BaseView');
        $view->setTemplate(Utility::getResourcePath('Form/datetimeField', 'Backend', 'Backend', 'Helper'));

        $view->assignMultiple(
            [
                'name'       => $name,
                'label'      => $label,
                'value'      => $value,
                'fieldName'  => $fieldName,
                'fieldId'    => $fieldId,
                'fieldLabel' => $fieldLabel
            ]
        );

        return $view->render();
    }

    /**
     * Wizard helper method to show a simple text field with a label
     *
     * @param string $name Input name
     * @param string $label Input label
     * @param string $value Input default value
     * @param array $arguments Additional parameters to pass onto the wizard (like "prefix", etc)
     *
     * @return string
     */
    public function textField($name, $label = '', $value = '', $arguments = array())
    {
        $fieldName  = $this->setFieldName($name);
        $fieldId    = $this->setFieldId($name);
        $fieldLabel = $this->setFieldLabel($name, $label);

        $view = Utility::createInstance('Continut\Core\Mvc\View\BaseView');
        $view->setTemplate(Utility::getResourcePath('Form/textField', 'Backend', 'Backend', 'Helper'));

        $view->assignMultiple(
            [
                'name'       => $name,
                'label'      => $label,
                'value'      => $value,
                'arguments'  => $arguments,
                'fieldName'  => $fieldName,
                'fieldId'    => $fieldId,
                'fieldLabel' => $fieldLabel
            ]
        );

        return $view->render();
    }

    /**
     * Wizard helper method to show a simple text field with a label
     *
     * @param string $name Input name
     * @param string $label Input label
     * @param string $value Input default value
     * @param array $arguments Additional parameters to pass onto the wizard (like "prefix", etc)
     *
     * @return string
     */
    public function mediaField($name, $label = '', $value = '', $arguments = array())
    {
        $fieldName  = $this->setFieldName($name);
        $fieldId    = $this->setFieldId($name);
        $fieldLabel = $this->setFieldLabel($name, $label);

        $view = Utility::createInstance('Continut\Core\Mvc\View\BaseView');
        $view->setTemplate(Utility::getResourcePath('Form/mediaField', 'Backend', 'Backend', 'Helper'));

        // if the field holds multiple images, their ids will be separated by commas
        if (mb_strlen(trim($value)) == 0) {
            $values = [];
        } else {
            $values = explode(',', $value);
        }

        $view->assignMultiple(
            [
                'name'       => $name,
                'label'      => $label,
                'value'      => $value,
                'values'     => $values,
                'arguments'  => $arguments,
                'fieldName'  => $fieldName,
                'fieldId'    => $fieldId,
                'fieldLabel' => $fieldLabel
            ]
        );

        return $view->render();
    }

    /**
     * Simple textarea field
     *
     * @param $name
     * @param $label
     * @param $value
     *
     * @return string
     */
    public function textareaField($name, $label, $value)
    {
        $fieldName  = $this->setFieldName($name);
        $fieldId    = $this->setFieldId($name);
        $fieldLabel = $this->setFieldLabel($name, $label);

        $html = <<<HER
        <div class="form-group">
            $fieldLabel
            <textarea id="$fieldId" name="$fieldName" class="form-control" rows="5">$value</textarea>
        </div>
HER;
        return $html;
    }

    /**
     * RTE field
     *
     * @param $name
     * @param $label
     * @param $value
     *
     * @return string
     */
    public function rteField($name, $label, $value)
    {
        $fieldName  = $this->setFieldName($name);
        $fieldId    = $this->setFieldId($name);
        $fieldLabel = $this->setFieldLabel($name, $label);

        $view = Utility::createInstance('Continut\Core\Mvc\View\BaseView');
        $view->setTemplate(Utility::getResourcePath('Form/rteField', 'Backend', 'Backend', 'Helper'));

        $view->assignMultiple(
            [
                'name'       => $name,
                'value'      => $value,
                'label'      => $label,
                'fieldName'  => $fieldName,
                'fieldId'    => $fieldId,
                'fieldLabel' => $fieldLabel
            ]
        );

        return $view->render();
    }

    /**
     * Select field
     *
     * @param string $name
     * @param string $label
     * @param array $values
     * @param mixed $selectedValue
     *
     * @return string
     */
    public function selectField($name, $label, $values, $selectedValue = null)
    {
        $fieldName  = $this->setFieldName($name);
        $fieldId    = $this->setFieldId($name);
        $fieldLabel = $this->setFieldLabel($name, $label);
        $options = array();

        /* if $values is an multiarray then it means we have optgroup definitions
         *
         * Example to generate a simple list of options
         * $values = ["value1" => "label 1", "value2" => "label 2"];
         *
         * And with multiarray for optgroups
         * $values = ["optgroup label" => ["value1" => "label1", "value2" => "label 2"]];
        */

        foreach ($values as $group => $data) {
            // do we have optgroups?
            if (is_array($data)) {
                if (!empty($group)) {
                    $options[] = "<optgroup label='$group'></optgroup>";
                }
                if ($data) {
                    foreach ($data as $key => $title) {
                        if ($key == $selectedValue) {
                            $options[] = "<option selected value='$key'>$title</option>";
                        } else {
                            $options[] = "<option value='$key'>$title</option>";
                        }
                    }
                }
                // or just simple arrays?
            } else {
                if ($group == $selectedValue) {
                    $options[] = "<option selected value='$group'>$data</option>";
                } else {
                    $options[] = "<option value='$group'>$data</option>";
                }
            }
        }
        $optionsSelect = implode("\n", $options);

        $html = <<<HER
            <div class="form-group">
                $fieldLabel
                <select name="$fieldName" id="$fieldId" class="form-control selectpicker">
                $optionsSelect
                </select>
            </div>
HER;

        return $html;

    }
}
