<form method="POST" id="content_edit"
      action="<?= $this->helper("Url")->linkToPath('admin_backend', ['_controller' => 'Settings', '_action' => 'saveDomain', 'id' => $domain->getId()]) ?>">
    <?= $this->helper("Wizard")->hiddenField("id", $domain->getId()); ?>
    <?= $this->partial('General/formValidator', 'Backend', 'Backend', ['model' => $domain])?>
    <div class="col-sm-12">
        <div class="panel panel-warning">
            <div class="panel-heading">
                <div class="panel-title">
                    <?= $this->__("backend.domain.properties.header") ?>
                </div>
            </div>
            <div class="panel-body">
                <div class="col-md-3">
                    <?= $this->helper("Wizard")->textField($domain, "title", $this->__("backend.domain.properties.title")) ?>
                </div>
                <div class="col-md-3">
                    <?= $this->helper("Wizard")->selectField($domain, "is_visible", $this->__("backend.domain.properties.isVisible"), [0 => $this->__("general.no"), 1 => $this->__("general.yes")]) ?>
                </div>
            </div>
            <div class="panel-footer">
                <input type="submit" name="submit" class="btn btn-primary"
                       value="<?= $this->__("general.save") ?>"/>
                <a class="close-button btn btn-danger pull-right"><?= $this->__("general.cancel") ?></a>
            </div>
        </div>
    </div>
</form>