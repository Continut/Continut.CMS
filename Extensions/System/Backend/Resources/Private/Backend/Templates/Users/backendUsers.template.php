<div class="quick-panel pull-right">
    <a href="" class="btn btn-success"><span class="fa fa-icon fa-plus"></span> <?= $this->__('backend.users.grid.addBackendUser') ?></a>
</div>
<h2><?= $this->__("backend.users.grid.title") ?></h2>

<div class="panel panel-default panel-grid">
    <div class="panel-heading">
        <div class="panel-title"><?= $this->__("backend.users.grid.title") ?></div>
    </div>
    <div class="panel-body">
        <?= $grid->render() ?>
    </div>
</div>

<div class="quick-panel">
    <a href="" class="btn btn-success"><span class="fa fa-icon fa-plus"></span> <?= $this->__('backend.users.grid.addBackendUser') ?></a>
</div>