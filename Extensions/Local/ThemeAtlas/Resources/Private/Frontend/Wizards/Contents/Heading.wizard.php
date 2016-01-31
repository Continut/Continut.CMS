<?php
	$title    = (!isset($title)) ? "" : $title;
	$subtitle = (!isset($subtitle)) ? "" : $subtitle;
?>
<div class="form-group">
	<?= $this->helper("Wizard")->textField("title", $this->__("backend.content.wizard.title"), $title) ?>
</div>
<div class="form-group">
	<?= $this->helper("Wizard")->textField("subtitle", $this->__("backend.content.wizard.subtitle"), $subtitle) ?>
</div>