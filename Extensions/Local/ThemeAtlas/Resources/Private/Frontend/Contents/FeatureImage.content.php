<?php
$width  = (!isset($width)) ? 800 : $width;
$height = (!isset($height)) ? null : $height;
$image  = (!isset($image)) ? null : $image;
?>
<div data-scroll-reveal="enter from the bottom after 0.4s" class="feature-img">
	<img class="img-responsive" src="<?= $this->helper('Image')->resize($image, $width, $height) ?>" alt="">
</div>