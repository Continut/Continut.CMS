<?php
$this->getPageView()
    ->addCssAsset(["identifier" => "bootstrap", "extension" => "ThemeBootstrap", "file" => "bootstrap.css"])
    ->addJsAsset(["identifier" => "bootstrap", "extension" => "ThemeBootstrap", "file" => "bootstrap.js"]);
?>

    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <?= $this->plugin("ThemeBootstrap", "Menu", "showMenu"); ?>
                <?= $this->partial('Index/index', 'ThemeBootstrap', 'Frontend'); ?>
            </div>
        </div>
        <div class="panel panel-danger">
            <div class="panel-heading">
                <div class="panel-title">HEADER</div>
            </div>
            <div class="panel-body">
                <?= $this->showContainerColumn(1); ?>
            </div>
        </div>

        <div style="row">
            <div class="col-sm-6">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <div class="panel-title">LEFT</div>
                    </div>
                    <div class="panel-body">
                        <?= $this->showContainerColumn(2); ?>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <div class="panel-title">RIGHT</div>
                    </div>
                    <div class="panel-body">
                        <?= $this->showContainerColumn(3); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php $this->getPageView()
    ->addCssAsset(["identifier" => "bootstrap-theme", "extension" => "ThemeBootstrap", "file" => "bootstrap-theme.css"])
    ->addJsAsset(["identifier" => "jquery", "extension" => "ThemeBootstrap", "file" => "jquery-1.11.2.js", "before" => "bootstrap"]); ?>