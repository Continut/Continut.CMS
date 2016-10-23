<div class="grid">
    <form method="post" action="<?= $this->getFormAction() ?>" class="form">
        <div class="row grid-paginator">
            <div class="col-sm-6">
                <?= $this->partial("Grid/paginator", "Backend", "Backend", ["grid" => $this]) ?>
            </div>
            <div class="col-sm-6 text-right">
                <a href="<?= $this->getFormAction() ?>" class="btn btn-danger"><span
                        class="fa fa-icon fa-refresh"></span> <?= $this->__("backend.grid.form.resetFilters") ?></a>
                <input type="submit" class="btn btn-primary" value="<?= $this->__("backend.grid.form.search") ?>"/>
            </div>
        </div>

        <div class="row grid-row grid-even">
            <?php foreach ($this->getFields() as $fieldName => $field): ?>
                <div class="<?= ($field->getCss()) ? $field->getCss() : 'col-sm-1'; ?>">
                    <div class="form-group">
                        <label><?= $this->__($field->getLabel()) ?></label>
                        <?php if ($field->getFilter()): ?>
                            <?= $field->getFilter()->render() ?>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endforeach ?>
        </div>

        <?php foreach ($this->getCollection()->getAll() as $index => $record): ?>
            <div class="row grid-row <?= ($index % 2 == 0) ? '' : 'grid-even' ?>">
                <?php foreach ($this->getFields() as $fieldName => $field): ?>
                    <div class="<?= ($field->getCss()) ? $field->getCss() : 'col-sm-1'; ?>">
                        <?= $field->getRenderer()->setRecord($record)->render() ?>
                    </div>
                <?php endforeach ?>
            </div>
        <?php endforeach ?>

        <div class="row grid-paginator">
            <div class="col-sm-6">
                <?= $this->partial("Grid/paginator", "Backend", "Backend", ["grid" => $this]) ?>
            </div>
            <div class="col-sm-6 text-right">
            </div>
        </div>

    </form>
</div>