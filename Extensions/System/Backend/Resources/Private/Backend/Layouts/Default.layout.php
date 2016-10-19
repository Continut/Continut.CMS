<?php
$this->getPageView()
    // css files
    ->addCssAsset(['identifier' => 'bootstrap',          'extension' => 'Backend', 'file' => 'bootstrap/bootstrap.css'])
    ->addCssAsset(['identifier' => 'bootstrap-theme',    'extension' => 'Backend', 'file' => 'bootstrap/bootstrap-theme.css'])
    ->addCssAsset(['identifier' => 'bootstrap-select',   'extension' => 'Backend', 'file' => 'bootstrap-select/bootstrap-select.css'])
    ->addCssAsset(['identifier' => 'bootstrap-dialog',   'extension' => 'Backend', 'file' => 'bootstrap-dialog/bootstrap-dialog.css'])
    ->addCssAsset(['identifier' => 'datetimepicker',     'extension' => 'Backend', 'file' => 'datetimepicker/DateTimePicker.css'])
    ->addCssAsset(['identifier' => 'fontawesome',        'extension' => 'Backend', 'file' => 'fontawesome/font-awesome.css'])
    ->addCssAsset(['identifier' => 'flagicons',          'extension' => 'Backend', 'file' => 'flagicons/flag-icon.css'])
    ->addCssAsset(['identifier' => 'jstree',             'extension' => 'Backend', 'file' => 'jstree/themes/continut/style.css'])
    ->addCssAsset(['identifier' => 'local',              'extension' => 'Backend', 'file' => 'local/backend.css'])
    // js files
    ->addJsAsset(['identifier' => 'jquery',              'extension' => 'Backend', 'file' => 'jquery/jquery-3.1.1.min.js'])
    ->addJsAsset(['identifier' => 'bootstrap',           'extension' => 'Backend', 'file' => 'bootstrap/bootstrap.min.js'])
    ->addJsAsset(['identifier' => 'bootstrap-select',    'extension' => 'Backend', 'file' => 'bootstrap-select/bootstrap-select.js'])
    ->addJsAsset(['identifier' => 'bootstrap-dialog',    'extension' => 'Backend', 'file' => 'bootstrap-dialog/bootstrap-dialog.min.js'])
    ->addJsAsset(['identifier' => 'datetimepicker',      'extension' => 'Backend', 'file' => 'datetimepicker/DateTimePicker.min.js'])
    ->addJsAsset(['identifier' => 'datetimepicker-i18n', 'extension' => 'Backend', 'file' => 'datetimepicker/i18n/DateTimePicker-i18n.js'])
    ->addJsAsset(['identifier' => 'jstree',              'extension' => 'Backend', 'file' => 'jstree/jstree.js'])
    ->addJsAsset(['identifier' => 'pep',                 'extension' => 'Backend', 'file' => 'pep/jquery.pep.js'])
    ->addJsAsset(['identifier' => 'wysihtml-toolbar',    'extension' => 'Backend', 'file' => 'wysihtml/wysihtml-toolbar.min.js'])
    ->addJsAsset(['identifier' => 'wysihtml-parser',     'extension' => 'Backend', 'file' => 'wysihtml/parser_rules/advanced_and_extended.js'])
    ->addJsAsset(['identifier' => 'local',               'extension' => 'Backend', 'file' => 'local/backend.js']);
?>
<div id="main_toolbar" class="collapse navbar-collapse">
    <div class="pull-left">
        <h1><img src="<?= $this->helper('Image')->getPath('Images/logo_alb.svg', 'Backend'); ?>" height="32" alt="Continut CMS" /> Conţinut CMS
            <small>v 0.0.1</small>
        </h1>
    </div>
    <ul class="nav navbar-nav navbar-right">
        <li>
            <a href="<?= $this->helper('Url')->linkToAction('Backend', 'Settings', 'index') ?>"><i
                    class="fa fa-fw fa-cogs"></i> <?= $this->__('backend.menu.settings') ?></a>
        </li>
        <li role="presentation" class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-expanded="false"><i
                    class="fa fa-fw fa-user"></i> <?= \Continut\Core\Utility::getSession()->getUser()->getName(); ?> <span class="caret"></span></a>
            <ul class="dropdown-menu" role="menu">
                <li><a href="<?= $this->helper('Url')->linkToAction('Backend', 'User', 'profile') ?>">User profile</a>
                </li>
                <li class="divider"></li>
                <li><a href="<?= $this->helper('Url')->linkToAction('Backend', 'Login', 'logout') ?>">Logout</a></li>
            </ul>
        </li>
    </ul>
</div>
<nav class="navbar navbar-default" id="mainmenu">
    <div class="container-fluid">
        <?= \Continut\Core\Utility::callPlugin('Backend', 'Index', 'mainmenu'); ?>
    </div>
</nav>
<div id="container" class="container-fluid">
    <?= $this->showContent(); ?>
</div>
<div id="dtBox"></div>