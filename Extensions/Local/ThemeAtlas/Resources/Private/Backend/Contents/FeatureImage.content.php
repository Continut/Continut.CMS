<?php
	$width  = (!isset($width)) ? 800 : $width;
	$height = (!isset($height)) ? null : $height;
?>
<img class="img-responsive img-centered" src="<?= $this->helper('Image')->resize($image, $width, $height, "backend") ?>" alt=""/>
