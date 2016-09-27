<?php
$this->getPageView()
    ->setBodyClass('login-page')
    ->addCssAsset(["identifier" => "local", "extension" => "Backend", "file" => "login/login.css"])
    ->addCssAsset(["identifier" => "libre-franklin-font", "external" => TRUE, "file" => "//fonts.googleapis.com/css?family=Libre+Franklin:400,700&subset=latin-ext"])
    ->addJsAsset(["identifier" => "jquery", "extension" => "Backend", "file" => "jquery/jquery-3.1.0.min.js"]);
?>

<?= $this->showContent(); ?>