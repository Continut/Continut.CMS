<?php
$icon      = (!isset($icon)) ? "fa-tablet" : $icon;
$title     = (!isset($title)) ? "" : $title;
$subtitle  = (!isset($subtitle)) ? null : $subtitle;
$align    = (!isset($align)) ? "text-center" : $align;
?>
<div data-scroll-reveal="enter from the bottom after 0.4s" class="about-box <?= $align ?>">
	<div class="about-border"> <i class="fa <?= $icon ?> aligncenter"></i></div>
	<h3><?= $title ?></h3>
	<p><?= $subtitle ?></p>
</div>