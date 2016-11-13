<?php
$this->getPageView()
    ->addCssAsset(["identifier" => "bootstrap", "extension" => "ThemeContinutOrg", "file" => "bootstrap.min.css"])
    ->addCssAsset(["identifier" => "main",      "extension" => "ThemeContinutOrg", "file" => "continut.css"])
    ->addCssAsset(["identifier" => "icons",     "extension" => "ThemeContinutOrg", "file" => "continut_icons.css"])
    ->addJsAsset(["identifier"  => "jquery",    "extension" => "ThemeContinutOrg", "file" => "jquery-3.1.1.slim.min.js"])
    ->addJsAsset(["identifier"  => "bootstrap", "extension" => "ThemeContinutOrg", "file" => "bootstrap.min.js"]);
?>

    <?= $this->plugin("ThemeContinutOrg", "Menu", "showMenu"); ?>

    <?= $this->showContainerColumn(1); ?>

    <?= $this->plugin("ThemeContinutOrg", "Menu", "showFooter"); ?>