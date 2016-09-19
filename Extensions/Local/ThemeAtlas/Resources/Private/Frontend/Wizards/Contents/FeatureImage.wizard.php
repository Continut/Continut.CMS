<?php
$width = (!isset($width)) ? 800 : $width;
$height = (!isset($height)) ? null : $height;
$image = (!isset($image)) ? null : $image;
?>
<div class="form-group">
    <?= $this->helper("Wizard")->textField("image", $this->__("backend.wizard.image"), $image) ?>
</div>
<div class="row">
    <div class="col-md-3">
        <div class="form-group">
            <?= $this->helper("Wizard")->textField("width", $this->__("backend.wizard.width"), $width) ?>
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <?= $this->helper("Wizard")->textField("height", $this->__("backend.wizard.height"), $height) ?>
        </div>
    </div>
</div>