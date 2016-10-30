<?php
$this->getPageView()
    ->setBodyClass('login-page')
    ->addCssAsset(["identifier" => "local", "extension" => "Backend", "file" => "login/login.css"])
    ->addJsAsset(["identifier" => "jquery", "extension" => "Backend", "file" => "jquery/jquery-3.1.1.min.js"]);
?>

<?= $this->showContent(); ?>