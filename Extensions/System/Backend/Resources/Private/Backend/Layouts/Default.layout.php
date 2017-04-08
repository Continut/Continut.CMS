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
    ->addJsAsset(['identifier' => 'bootstrap-dialog',    'extension' => 'Backend', 'file' => 'bootstrap-dialog/bootstrap-dialog.js'])
    ->addJsAsset(['identifier' => 'datetimepicker',      'extension' => 'Backend', 'file' => 'datetimepicker/DateTimePicker.min.js'])
    ->addJsAsset(['identifier' => 'datetimepicker-i18n', 'extension' => 'Backend', 'file' => 'datetimepicker/i18n/DateTimePicker-i18n.js'])
    ->addJsAsset(['identifier' => 'jstree',              'extension' => 'Backend', 'file' => 'jstree/jstree.js'])
    ->addJsAsset(['identifier' => 'pep',                 'extension' => 'Backend', 'file' => 'pep/jquery.pep.js'])
    ->addJsAsset(['identifier' => 'wysihtml',            'extension' => 'Backend', 'file' => 'wysihtml/wysihtml.min.js'])
    ->addJsAsset(['identifier' => 'wysihtml-toolbar',    'extension' => 'Backend', 'file' => 'wysihtml/wysihtml.toolbar.min.js'])
    ->addJsAsset(['identifier' => 'wysihtml-parser',     'extension' => 'Backend', 'file' => 'wysihtml/parser_rules/advanced_and_extended.js'])
    ->addJsAsset(['identifier' => 'local',               'extension' => 'Backend', 'file' => 'local/backend.js']);
?>
<nav class="navbar navbar-default" id="main_toolbar">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#main_toolbar_collapse" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="<?= $this->helper('Url')->linkToPath('admin', ['_controller' => 'Index', '_action' => 'dashboard']); ?>">
                <h1><img src="<?= $this->helper('Image')->getPath('Images/logo_negru.svg', 'Backend'); ?>" height="32" alt="Continut CMS" class="pull-left"/> <?= $this->__('product.name') ?> <br/><small><?= $this->__('product.version', ['version' => \Continut\Core\Utility::getVersion()]) ?></small></h1>
            </a>
        </div>

        <div class="collapse navbar-collapse" id="main_toolbar_collapse">
            <form class="navbar-form navbar-left" id="search_form">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="search">
                    <span class="input-group-btn">
                        <button class="btn btn-default" type="button"><i class="fa fa-search"></i></button>
                    </span>
                </div>
            </form>

            <ul class="nav navbar-nav navbar-right">
                <li>
                    <a href="<?= $this->helper('Url')->linkToPath('admin', ['_controller' => 'Settings', '_action' => 'favorites']) ?>">
                        <i class="fa fa-fw fa-2x fa-star-o"></i> <?= $this->__('backend.menu.favorites') ?>
                    </a>
                </li>
                <li class="dropdown">
                    <?= \Continut\Core\Utility::callPlugin('Backend', 'Index', 'notifications'); ?>
                </li>
                <li>
                    <a href="<?= $this->helper('Url')->linkToPath('admin', ['_controller' => 'Settings', '_action' => 'index']) ?>" title="<?= $this->__('backend.menu.settings') ?>">
                        <i class="fa fa-fw fa-2x fa-cogs"></i> <?= $this->__('backend.menu.settings') ?>
                    </a>
                </li>
                <li role="presentation" class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-expanded="false">
                        <img src="<?= $this->helper('Image')->getPath('Images/profile_pic.jpg', 'Backend'); ?>" height="24" alt="" class="img-circle"> <?= \Continut\Core\Utility::getSession()->getUser()->getName(); ?> <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="<?= $this->helper('Url')->linkToPath('admin', ['_controller' => 'User', '_action' => 'profile']) ?>">User profile</a>
                        </li>
                        <li class="divider"></li>
                        <li><a href="<?= $this->helper('Url')->linkToPath('admin', ['_controller' => 'Login', '_action' => 'logout']) ?>">Logout</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>

<nav class="navbar navbar-default" id="main_menu">
    <div class="container-fluid">
        <?= \Continut\Core\Utility::callPlugin('Backend', 'Index', 'mainmenu'); ?>
    </div>
</nav>
<div id="container" class="container-fluid">
    <?= $this->showContent(); ?>
</div>
<div id="dtBox"></div>