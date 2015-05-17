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
		 * Shows a simple text field with a label in a wizard
		 *
		 * @param        $name
		 * @param        $label
		 * @param string $value
		 *
		 * @return string
		 */
		public function textField($name, $label, $value = "") {
			$html = <<<HER
			<label for="field_$name">$label</label>
			<input id="field_$name" type="text" class="form-control" value="$value" />
HER;
			return $html;
		}

		public function textareaField($name, $label, $value) {
			$html = <<<HER
			<label for="field_$name">$label</label>
			<textarea id="field_$name" class="form-control" rows="5">$value</textarea>
HER;
			return $html;
		}

		public function rteField($name, $label, $value) {
			$html = <<<HER
			<label for="field_$name">$label</label>
			<div class="btn-toolbar" data-role="editor-toolbar" data-target="#field_$name">
				<div class="btn-group">
			  		<a class="btn btn-default" data-edit="bold"><i class="fa fa-fw fa-bold"></i></a>
			  		<a class="btn btn-default" data-edit="italic"><i class="fa fa-fw fa-italic"></i></a>
			  		<a class="btn btn-default" data-edit="underline"><i class="fa fa-fw fa-underline"></i></a>
			  		<a class="btn btn-default" data-edit="strikethrough"><i class="fa fa-fw fa-strikethrough"></i></a>
			  	</div>
			</div>
			<div id="field_$name" class="form-control rte">$value</div>
			<script type="text/javascript">$('#field_$name').wysiwyg()</script>
HER;
			return $html;
		}
	}

}
