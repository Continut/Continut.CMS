<?php
$sizeLeft = $formatColumns;
$sizeRight = 12 - $formatColumns;
?>

<div class="row">
    <div class="col-lg-<?= $sizeLeft ?>">
        <div class="panel panel-warning">
            <div class="panel-heading">
                <div
                    class="panel-title"><?= $this->__('backend.themeBootstrapModerna.layout.container.column1') ?>
                </div>
            </div>
            <div class="panel-body">
                <?= $this->showContainerColumn(4); ?>
            </div>
        </div>
    </div>
    <div class="col-lg-<?= $sizeRight ?>">
        <div class="panel panel-warning">
            <div class="panel-heading">
                <div
                    class="panel-title"><?= $this->__('backend.themeBootstrapModerna.layout.container.column2') ?>
                </div>
            </div>
            <div class="panel-body">
                <?= $this->showContainerColumn(5); ?>
            </div>
        </div>
    </div>
</div>