<?php
$this->getPageView()
    ->setBodyClass('login-page')
    ->addCssAsset( [ "identifier" => "bootstrap", "extension" => "Backend", "file" => "bootstrap/bootstrap.min.css" ])
    ->addCssAsset( [ "identifier" => "bootstrap-select", "extension" => "Backend", "file" => "bootstrap-select/bootstrap-select.css" ])
    ->addCssAsset( [ "identifier" => "bootstrap-dialog", "extension"  => "Backend", "file" => "bootstrap-dialog/bootstrap-dialog.css" ])
    ->addCssAsset( [ "identifier" => "fontawesome", "extension" => "Backend", "file" => "fontawesome/font-awesome.css" ])
    ->addCssAsset( [ "identifier" => "flagicons", "extension" => "Backend", "file" => "flagicons/flag-icon.css" ])
    ->addCssAsset( [ "identifier" => "local", "extension" => "Backend", "file" => "local/backend.css" ])
    ->addCssAsset( [ "identifier" => "google-roboto-font", "external" => TRUE, "file" => "//fonts.googleapis.com/css?family=Roboto+Condensed&subset=latin,latin-ext,cyrillic-ext,greek-ext,greek,vietnamese,cyrillic"])
    ->addJsAsset( [ "identifier" => "jquery", "extension"  => "Backend", "file" => "jquery/jquery-1.11.3.min.js" ])
    ->addJsAsset( [ "identifier" => "bootstrap", "extension"  => "Backend", "file" => "bootstrap/bootstrap.min.js" ])
    ->addJsAsset( [ "identifier" => "bootstrap-select", "extension"  => "Backend", "file" => "bootstrap-select/bootstrap-select.js" ])
    ->addJsAsset( [ "identifier" => "bootstrap-dialog", "extension"  => "Backend", "file" => "bootstrap-dialog/bootstrap-dialog.min.js" ]);
?>

<div id="main_toolbar" class="collapse navbar-collapse">
    <div class="pull-left">
        <h1><i class="fa fa-cc"></i> Conţinut CMS <small>v 0.0.1</small></h1>
    </div>
    <ul class="nav navbar-nav navbar-right">
        <li role="presentation" class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-expanded="false"><i class="fa fa-fw fa-question-circle"></i> <?= $this->__("login.helpmenu.gettingStarted") ?> <span class="caret"></span></a>
            <ul class="dropdown-menu" role="menu">
                <li><a href="#"><span class="fa fa-fw fa-book"></span> <?= $this->__("login.helpmenu.checkDocumentation") ?></a></li>
                <li class="divider"></li>
                <li><a href="#"><span class="fa fa-fw fa-youtube-play"></span> <?= $this->__("login.helpmenu.checkHowToEditors") ?></a></li>
            </ul>
        </li>
    </ul>
</div>

<div id="container" class="container-fluid">
    <?= $this->showContent(); ?>
</div>