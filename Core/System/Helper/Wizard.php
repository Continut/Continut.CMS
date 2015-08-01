<?php
/**
 * This file is part of the Conţinut CMS project.
 * Distributed under the GNU General Public License.
 * For more details, consult the LICENSE.txt file supplied with the project
 
 * Author: Radu Mogoş <radu.mogos@pixelplant.ch>
 * Date: 17.05.2015 @ 10:31
 * Project: Conţinut CMS
 */
namespace Core\System\Helper {

	class Wizard {

		/**
		 * @var string Field prefix used in the backend form
		 */
		protected $prefix = "data";

		/**
		 * Shows a simple text field with a label in a wizard
		 *
		 * @param        $name
		 * @param        $label
		 * @param string $value
		 *
		 * @return string
		 */
		public function textField($name, $label, $value = "") {
			$fieldName = $this->prefix . "[$name]";
			$html = <<<HER
			<label for="field_$name">$label</label>
			<input id="field_$name" type="text" class="form-control" value="$value" name="$fieldName"/>
HER;
			return $html;
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
		public function textareaField($name, $label, $value) {
			$fieldName = $this->prefix . "[$name]";
			$html = <<<HER
			<label for="field_$name">$label</label>
			<textarea id="field_$name" name="$fieldName" class="form-control" rows="5">$value</textarea>
HER;
			return $html;
		}

		/**
		 * RTE field
		 * @param $name
		 * @param $label
		 * @param $value
		 *
		 * @return string
		 */
		public function rteField($name, $label, $value) {
			$fieldName = $this->prefix . "[$name]";
			$html = <<<HER
			<label for="field_$name">$label</label>
			<div class="rte-toolbar" id="rte_toolbar_$name">
				<div class="btn-group">
			  		<a class="btn btn-default" data-wysihtml5-command="bold"><i class="fa fa-fw fa-bold"></i></a>
			  		<a class="btn btn-default" data-wysihtml5-command="italic"><i class="fa fa-fw fa-italic"></i></a>
			  		<a class="btn btn-default" data-wysihtml5-command="underline"><i class="fa fa-fw fa-underline"></i></a>
				</div>
				<div class="btn-group">
					<a class="btn btn-default" data-wysihtml5-command="alignLeftStyle"><i class="fa fa-fw fa-align-left"></i></a>
					<a class="btn btn-default" data-wysihtml5-command="alignCenterStyle"><i class="fa fa-fw fa-align-center"></i></a>
					<a class="btn btn-default" data-wysihtml5-command="alignRightStyle"><i class="fa fa-fw fa-align-right"></i></a>
				</div>
				<div class="btn-group">
					<a class="btn btn-default" data-wysihtml5-command="insertUnorderedList"><i class="fa fa-fw fa-list"></i></a>
					<a class="btn btn-default" data-wysihtml5-command="insertOrderedList"><i class="fa fa-fw fa-list-ol"></i></a>
				</div>
				<select class="selectpicker">
					<option value="p" data-wysihtml5-command="formatBlock" data-wysihtml5-command-value="p" data-icon="fa fa-fw fa-paragraph">Paragraph</option>
					<option value="h1" data-wysihtml5-command="formatBlock" data-wysihtml5-command-value="h1" data-icon="fa fa-fw fa-header">Heading 1</option>
					<option value="h2" data-wysihtml5-command="formatBlock" data-wysihtml5-command-value="h2" data-icon="fa fa-fw fa-header">Heading 2</option>
					<option value="h3" data-wysihtml5-command="formatBlock" data-wysihtml5-command-value="h3" data-icon="fa fa-fw fa-header">Heading 3</option>
					<option value="h4" data-wysihtml5-command="formatBlock" data-wysihtml5-command-value="h4" data-icon="fa fa-fw fa-header">Heading 4</option>
					<option value="h5" data-wysihtml5-command="formatBlock" data-wysihtml5-command-value="h5" data-icon="fa fa-fw fa-header">Heading 5</option>
					<option value="">-- No format block --</option>
				</select>
			  	<a class="btn btn-default" data-wysihtml5-action="change_view"><i class="fa fa-fw fa-code"></i></a>
			</div>
			<textarea id="field_$name" name="$fieldName" class="form-control rte">$value</textarea>
			<script type="text/javascript">
			var editor_$name = new wysihtml5.Editor('field_$name', {
				toolbar: 'rte_toolbar_$name',
				parserRules:  wysihtml5ParserRules
			});
			$('.selectpicker').selectpicker();
			</script>
HER;
			return $html;
		}

		/**
		 * Select field
		 *
		 * @param string $name
		 * @param string $label
		 * @param array  $values
		 * @param mixed  $selectedValue
		 *
		 * @return string
		 */
		public function selectField($name, $label, $values, $selectedValue = null) {
			$fieldName = $this->prefix . "[$name]";
			foreach ($values as $key => $title) {
				if ($key == $selectedValue) {
					$options[] = "<option selected value='$key'>$title</option>";
				} else {
					$options[] = "<option value='$key'>$title</option>";
				}
			}
			$optionsSelect = implode("\n", $options);

			$html = <<<HER
				<label for="field_$name">$label</label>
				<select name="$fieldName" id="field_$name" class="form-control selectpicker">
				$optionsSelect
				</select>
HER;

			return $html;

		}
	}

}