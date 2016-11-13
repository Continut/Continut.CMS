<div class="row">
    <div class="col-sm-8">
        <div class="panel panel-success">
            <div class="panel-heading">
                <div class="panel-title"><?= $this->__("backend.themeBootstrap.layout.container.leftColumn") ?></div>
            </div>
            <div class="panel-body">
                <?= $this->showContainerColumn(1); ?>
            </div>
        </div>
    </div>
    <div class="col-sm-4">
        <div class="panel panel-success">
            <div class="panel-heading">
                <div class="panel-title"><?= $this->__("backend.themeBootstrap.layout.container.rightColumn") ?></div>
            </div>
            <div class="panel-body">
                <?= $this->showContainerColumn(2); ?>
            </div>
        </div>
    </div>
</div>
