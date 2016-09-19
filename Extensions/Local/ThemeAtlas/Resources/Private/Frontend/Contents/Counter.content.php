<?php
$icon = (!isset($icon)) ? "fa-tablet" : $icon;
$title = (!isset($title)) ? "" : $title;
$subtitle = (!isset($subtitle)) ? null : $subtitle;
$align = (!isset($align)) ? "text-center" : $align;
?>
<div class="milestone-counter <?= $align ?>">
    <i class="fa <?= $icon ?> fa-3x"></i>
    <span class="stat-count highlight"><?= $title ?></span>
    <div class="milestone-details"><?= $subtitle ?></div>
</div>