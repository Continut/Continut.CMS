<?php
$this->getPageView()
    ->addCssAsset( [ "identifier" => "bootstrap", "extension" => "Backend", "file" => "bootstrap-themes/simplex.min.css" ])
    ->addCssAsset( [ "identifier" => "bootstrap-select", "extension" => "Backend", "file" => "bootstrap-select/bootstrap-select.css" ])
    ->addCssAsset( [ "identifier" => "bootstrap-dialog", "extension"  => "Backend", "file" => "bootstrap-dialog/bootstrap-dialog.css" ])
    ->addCssAsset( [ "identifier" => "datetimepicker", "extension" => "Backend", "file" => "datetimepicker/DateTimePicker.css" ])
    ->addCssAsset( [ "identifier" => "fontawesome", "extension" => "Backend", "file" => "fontawesome/font-awesome.css" ])
    ->addCssAsset( [ "identifier" => "flagicons", "extension" => "Backend", "file" => "flagicons/flag-icon.css" ])
    ->addCssAsset( [ "identifier" => "jqtree", "extension" => "Backend", "file" => "jqtree/jqtree.css" ])
    ->addCssAsset( [ "identifier" => "local", "extension" => "Backend", "file" => "local/backend.css" ])
    ->addCssAsset( [ "identifier" => "google-roboto-font", "external" => TRUE, "file" => "//fonts.googleapis.com/css?family=Roboto+Condensed&subset=latin,latin-ext,cyrillic-ext,greek-ext,greek,vietnamese,cyrillic"])
    ->addJsAsset( [ "identifier" => "jquery", "extension"  => "Backend", "file" => "jquery/jquery-1.11.3.min.js" ])
    ->addJsAsset( [ "identifier" => "bootstrap", "extension"  => "Backend", "file" => "bootstrap/bootstrap.min.js" ])
    ->addJsAsset( [ "identifier" => "bootstrap-select", "extension"  => "Backend", "file" => "bootstrap-select/bootstrap-select.js" ])
    ->addJsAsset( [ "identifier" => "bootstrap-dialog", "extension"  => "Backend", "file" => "bootstrap-dialog/bootstrap-dialog.min.js" ])
    ->addJsAsset( [ "identifier" => "datetimepicker", "extension"  => "Backend", "file" => "datetimepicker/DateTimePicker.min.js" ])
    ->addJsAsset( [ "identifier" => "datetimepicker-i18n", "extension"  => "Backend", "file" => "datetimepicker/i18n/DateTimePicker-i18n.js" ])
    ->addJsAsset( [ "identifier" => "tree", "extension"  => "Backend", "file" => "jqtree/tree.jquery.js" ])
    ->addJsAsset( [ "identifier" => "pep", "extension"  => "Backend", "file" => "pep/jquery.pep.js" ])
    ->addJsAsset( [ "identifier" => "wysihtml-toolbar", "extension"  => "Backend", "file" => "wysihtml/wysihtml-toolbar.min.js" ])
    ->addJsAsset( [ "identifier" => "wysihtml-parser", "extension"  => "Backend", "file" => "wysihtml/parser_rules/advanced_and_extended.js" ])
    ->addJsAsset( [ "identifier" => "local", "extension"  => "Backend", "file" => "local/backend.js" ]);
?>
<div id="main_toolbar" class="collapse navbar-collapse">
    <div class="pull-left">
        <h1><i class="fa fa-cc"></i> Conţinut CMS <small>v 0.0.1</small></h1>
    </div>
    <ul class="nav navbar-nav navbar-right">
        <li>
            <a href="<?= $this->helper("Url")->linkToAction("Backend", "Settings", "index") ?>"><i class="fa fa-fw fa-cogs"></i> Settings</a>
        </li>
        <li role="presentation" class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-expanded="false"><i class="fa fa-fw fa-user"></i> Gringo Deluxe <span class="caret"></span></a>
            <ul class="dropdown-menu" role="menu">
                <li><a href="<?= $this->helper("Url")->linkToAction("Backend", "User", "profile") ?>">User profile</a></li>
                <li class="divider"></li>
                <li><a href="<?= $this->helper("Url")->linkToAction("Backend", "Login", "logout") ?>">Logout</a></li>
            </ul>
        </li>
    </ul>
</div>
<nav class="navbar navbar-default" id="mainmenu">
    <div class="container-fluid">
        <?= \Continut\Core\Utility::callPlugin("Backend", "Index", "mainmenu"); ?>
    </div>
</nav>
<div id="container" class="container-fluid">
    <?= $this->showContent(); ?>
</div>
<div id="dtBox"></div>