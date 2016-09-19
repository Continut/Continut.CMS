<?php
$image = (!isset($image)) ? null : $image;
$title = (!isset($title)) ? null : $title;
?>
<div class="form-group">
    <?= $this->helper("Wizard")->textField("title", $this->__("backend.wizard.title"), $title) ?>
</div>
<div class="form-group">
    <?= $this->helper("Wizard")->textField("image", $this->__("backend.wizard.image"), $image) ?>
</div>