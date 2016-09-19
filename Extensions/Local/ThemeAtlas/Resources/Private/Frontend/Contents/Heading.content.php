<?php
$title = (!isset($title)) ? "" : $title;
$subtitle = (!isset($subtitle)) ? "" : $subtitle;
?>
<div data-scroll-reveal="enter from the bottom after 0.3s" class="title text-center" data-scroll-reveal-id="2"
     data-scroll-reveal-initialized="true" data-scroll-reveal-complete="true">
    <h2><?= $title ?></h2>
    <p><?= $subtitle ?></p>
    <hr>
</div>