<?php
$title    = (!isset($title)) ? "" : $title;
$subtitle = (!isset($subtitle)) ? "" : $subtitle;
$icon     = (!isset($icon)) ? "fa-tablet" : $icon;
$align    = (!isset($align)) ? "text-center" : $align;
?>

<div class="form-group">
	<?= $this->helper("Wizard")->textField("title", $this->__("backend.wizard.title"), $title) ?>
</div>
<div class="row">
	<div class="col-md-6">
		<div class="form-group">
			<?= $this->helper("Wizard")->selectField("icon", "Icon", ["fa-user" => "User", "fa-coffee" => "Coffee", "fa-trophy" => "Trophy", "fa-camera" => "Camera"], $icon) ?>
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group">
			<?= $this->helper("Wizard")->selectField("align", "Text alignment", ["text-left" => "Left", "text-center" => "Center", "text-right" => "Right"], $align) ?>
		</div>
	</div>
</div>
<div class="form-group">
	<?= $this->helper("Wizard")->textField("subtitle", "Content", $subtitle) ?>
</div>