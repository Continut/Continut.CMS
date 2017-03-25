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

/**
 * Class FormObject
 *
 * The FormObject class is a helper class that can be used to generate different form elements for
 * BaseModel objects, and it includes validation and display of error messages
 *
 * So, as a rule of thumb...
 * Whenever you need to show form inputs for a model, use the FormObject view helper
 * When you need to show form inputs not linked to a model, use the Form view helper instead
 *
 * @package Continut\Core\System\Helpers
 */
class FormObject
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
        $fieldName = $this->prefix . "[$name]";
        // if the field name contains a square bracket, it means it's an array
        // so we need to set it up accordingly
        if (strpos($name, '[')) {
            // extract only the field name
            $name = substr($name, 0, strpos($name, "["));
            $fieldName = $this->prefix . "[$name][]";
        }
        return $fieldName;
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
            $errorsClass = 'has-error';
            $errorMessages = '';
            foreach ($model->getValidationErrors($columnName) as $error) {
                $errorMessages .= "<p>$error</p>";
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
     * @param BaseModel $model
     * @param string $name
     * @param string $value
     *
     * @return string
     */
    public function hiddenField($model, $name, $value = '')
    {
        $fieldName = $this->setFieldName($name);

        // if no default value is set, get the one from the model
        if (!$value) {
            $value = $model->fetchFromField($name);
        }
        $html = <<<HER
			<input id="field_$name" type="hidden" class="form-control" value="$value" name="$fieldName"/>
HER;
        return $html;
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
        $fieldName = $this->setFieldName($name);
        $fieldLabel = $this->setFieldLabel($name, $label);

        $html = '';
        if (is_array($values)) {
            $fieldName = $fieldName . '[]';
            foreach ($values as $text => $value) {
                $id = 'field_' . $name . '_' . $value;
                $html .= <<<HER
					<input id="$id" type="text" value="$value" name="$fieldName"/> $text
HER;
            }
        } else {
            $html = <<<HER
				<div class="checkbox">
				$fieldLabel
				<input id="field_$name" class="form-control" type="checkbox" value="$selectedValue" name="$fieldName"/>
				</div>
HER;
        }
        return $html;
    }

    /**
     * Shows a simple DateTime field with a label in a wizard
     *
     * @param BaseModel $model Model object
     * @param string $name Input name
     * @param string $label Input label
     * @param string $value Default value
     *
     * @return string
     */
    public function dateTimeField($model, $name, $label, $value = '')
    {
        $fieldName  = $this->setFieldName($name);
        $fieldLabel = $this->setFieldLabel($name, $label);
        $errors     = $this->setErrors($model, $name);

        $html = <<<HER
			<div class="form-group {$errors['errorsClass']}">
				$fieldLabel
				<input id="field_$name" type="text" data-field="datetime" class="form-control" value="$value" name="$fieldName"/>
				{$errors['errorsBlock']}
			</div>
HER;
        return $html;
    }

    /**
     * Wizard helper method to show a simple text field with a label
     *
     * @param BaseModel $model Model object
     * @param string $name Input name
     * @param string $label Input label
     * @param string $value Input default value
     * @param array $arguments Additional parameters to pass onto the wizard (like "prefix", etc)
     *
     * @return string
     */
    public function textField($model, $name, $label = '', $value = '', $arguments = array())
    {
        $fieldName  = $this->setFieldName($name);
        $fieldLabel = $this->setFieldLabel($name, $label);
        $errors     = $this->setErrors($model, $name);

        // if no default value is set, get the one from the model
        if (!$value) {
            $value = $model->fetchFromField($name);
        }

        $input = <<<HER
			<input id="field_$name" type="text" class="form-control" value="$value" name="$fieldName"/>
HER;

        if (isset($arguments["prefix"])) {
            $prefix = $arguments["prefix"];
            $input = <<<HER
			<div class="input-group">
				<span class="input-group-addon">$prefix</span>
				$input
			</div>
HER;
        }

        $html = <<<HER
			<div class="form-group {$errors['errorsClass']}">
				$fieldLabel
				$input
				{$errors['errorsBlock']}
			</div>
HER;
        return $html;
    }

    /**
     * Simple textarea field
     *
     * @param BaseModel $model Model object
     * @param string $name
     * @param string $label
     * @param string $value
     *
     * @return string
     */
    public function textareaField($model, $name, $label, $value)
    {
        $fieldName = $this->setFieldName($name);
        $fieldLabel = $this->setFieldLabel($name, $label);
        $errors = $this->setErrors($model, $name);

        // if no default value is set, get the one from the model
        if (!$value) {
            $value = $model->fetchFromField($name);
        }

        $html = <<<HER
        <div class="form-group {$errors['errorsClass']}">
			$fieldLabel
			<textarea id="field_$name" name="$fieldName" class="form-control" rows="5">$value</textarea>
			{$errors['errorsBlock']}
		</div>
HER;
        return $html;
    }

    /**
     * RTE field
     *
     * @param BaseModel $model Model object
     * @param string $name
     * @param string $label
     * @param string $value
     * @param string $height Height of textarea
     *
     * @return string
     */
    public function rteField($model, $name, $label, $value, $height = '100px')
    {
        $fieldName = $this->setFieldName($name);
        $fieldLabel = $this->setFieldLabel($name, $label);
        $errors = $this->setErrors($model, $name);

        // if no default value is set, get the one from the model
        if (!$value) {
            $value = $model->fetchFromField($name);
        }

        $html = <<<HER
		<div class="form-group {$errors['errorsClass']}">
			$fieldLabel
			<div class="rte-toolbar" id="rte_toolbar_$name">
				<div class="btn-group">
			  		<a class="btn btn-default" data-wysihtml-command="bold"><i class="fa fa-fw fa-bold"></i></a>
			  		<a class="btn btn-default" data-wysihtml-command="italic"><i class="fa fa-fw fa-italic"></i></a>
			  		<a class="btn btn-default" data-wysihtml-command="underline"><i class="fa fa-fw fa-underline"></i></a>
				</div>
				<div class="btn-group">
					<a class="btn btn-default" data-wysihtml-command="alignLeftStyle"><i class="fa fa-fw fa-align-left"></i></a>
					<a class="btn btn-default" data-wysihtml-command="alignCenterStyle"><i class="fa fa-fw fa-align-center"></i></a>
					<a class="btn btn-default" data-wysihtml-command="alignRightStyle"><i class="fa fa-fw fa-align-right"></i></a>
				</div>
				<div class="btn-group">
					<a class="btn btn-default" data-wysihtml-command="insertUnorderedList"><i class="fa fa-fw fa-list"></i></a>
					<a class="btn btn-default" data-wysihtml-command="insertOrderedList"><i class="fa fa-fw fa-list-ol"></i></a>
				</div>
				<select class="selectpicker">
					<option value="p" data-wysihtml-command="formatBlock" data-wysihtml-command-value="p" data-icon="fa fa-fw fa-paragraph">Paragraph</option>
					<option value="h1" data-wysihtml-command="formatBlock" data-wysihtml-command-value="h1" data-icon="fa fa-fw fa-header">Heading 1</option>
					<option value="h2" data-wysihtml-command="formatBlock" data-wysihtml-command-value="h2" data-icon="fa fa-fw fa-header">Heading 2</option>
					<option value="h3" data-wysihtml-command="formatBlock" data-wysihtml-command-value="h3" data-icon="fa fa-fw fa-header">Heading 3</option>
					<option value="h4" data-wysihtml-command="formatBlock" data-wysihtml-command-value="h4" data-icon="fa fa-fw fa-header">Heading 4</option>
					<option value="h5" data-wysihtml-command="formatBlock" data-wysihtml-command-value="h5" data-icon="fa fa-fw fa-header">Heading 5</option>
					<option value="">-- No format block --</option>
				</select>
			  	<a class="btn btn-default" data-wysihtml-action="change_view"><i class="fa fa-fw fa-code"></i></a>
			</div>
			<textarea id="field_$name" name="$fieldName" class="form-control rte" style="height: $height">$value</textarea>
			<script type="text/javascript">
			var editor_$name = new wysihtml.Editor('field_$name', {
				toolbar: 'rte_toolbar_$name',
				parserRules: wysihtmlParserRules
			});
			$('.selectpicker').selectpicker();
			</script>
			{$errors['errorsBlock']}
		</div>
HER;
        return $html;
    }

    /**
     * Select field
     *
     * @param BaseModel $model Model object
     * @param string $name
     * @param string $label
     * @param array $values
     * @param mixed $selectedValue
     *
     * @return string
     */
    public function selectField($model, $name, $label, $values, $selectedValue = null)
    {
        $fieldName = $this->setFieldName($name);
        $fieldLabel = $this->setFieldLabel($name, $label);
        $errors = $this->setErrors($model, $name);
        $options = array();

        // if no default value is set, get the one from the model
        if (!$selectedValue) {
            $selectedValue = $model->fetchFromField($name);
        }

        /* if $values is an multiarray then it means we have optgroup definitions
         *
         * Example for simple list of options
         * $values = ["value1" => "label 1", "value2" => "label 2"];
         *
         * And with mutiarray for optgroups
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
			<div class="form-group {$errors['errorsClass']}">
				$fieldLabel
				<select name="$fieldName" id="field_$name" class="form-control selectpicker">
				$optionsSelect
				</select>
				{$errors['errorsBlock']}
			</div>
HER;

        return $html;

    }
}
