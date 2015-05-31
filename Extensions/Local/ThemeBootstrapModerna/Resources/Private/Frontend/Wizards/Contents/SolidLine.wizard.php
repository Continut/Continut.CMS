<div class="form-group">
	<?= $this->helper("Wizard")->textField("title", $this->__("backend.wizard.title"), $title) ?>
</div>
<div class="form-group">
	<?= $this->helper("Wizard")->selectField("lineType", "Line type", ["solid" => "Solid", "dashed" => "Dashed", "dotted" => "Dotted"], $lineType) ?>
</div>