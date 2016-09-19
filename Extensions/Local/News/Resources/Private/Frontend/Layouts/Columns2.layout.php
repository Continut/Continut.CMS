<?php
$this->getPage()
    ->addJsAsset(["identifier" => "bootstrap", "extension" => "News", "file" => "bootstrap.js"])
    ->addCssAsset(["identifier" => "bootstrap", "extension" => "News", "file" => "bootstrap.css"]);
?>

    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <h1><?= $this->getPage()->getTitle(); ?></h1>
            </div>
            <div class="col-sm-8">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="panel-title">Left column</div>
                    </div>
                    <div class="panel-body">
                        <?php $this->showContainerColumn(1); ?>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <div class="panel-title">Right column</div>
                    </div>
                    <div class="panel-body">
                        <?php $this->showContainerColumn(2); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php
$this->getPage()
    ->addCssAsset(["identifier" => "bootstrap-theme", "extension" => "News", "file" => "bootstrap-theme.css"])
    ->addJsAsset(["identifier" => "jquery", "extension" => "News", "file" => "jquery.js", "before" => "bootstrap"]);
?>