<form method="POST" id="content_edit"
      action="<?= $this->helper("Url")->linkToPath('admin_backend', ['_controller' => 'Settings', '_action' => 'saveDomainUrl', 'id' => $domainUrl->getId()]) ?>">
    <?= $this->helper("Wizard")->hiddenField("id", $domainUrl->getId()); ?>
    <?= $this->partial('General/formValidator', 'Backend', 'Backend', ['model' => $domainUrl])?>
    <div class="col-sm-12">
        <div class="panel panel-warning">
            <div class="panel-heading">
                <div class="panel-title">
                    <?= $this->__("backend.domainUrl.properties.header") ?>
                </div>
            </div>
            <div class="panel-body">
                <div class="col-md-3">
                    <?= $this->helper("Wizard")->textField($domainUrl, "title", $this->__("backend.domainUrl.properties.title")) ?>
                </div>
                <div class="col-md-3">
                    <?= $this->helper("Wizard")->selectField($domainUrl, "domain_id", $this->__("backend.domainUrl.properties.domainId"), $domains) ?>
                </div>
                <div class="col-md-6">
                    <?= $this->helper("Wizard")->textField($domainUrl, "url", $this->__("backend.domainUrl.properties.url"), $domainUrl->getUrl(), ["prefix" => "http://"]) ?>
                </div>
                <div class="col-md-3">
                    <?= $this->helper("Wizard")->textField($domainUrl, "locale", $this->__("backend.domainUrl.properties.locale")) ?>
                </div>
                <div class="col-md-3">
                    <?= $this->helper("Wizard")->selectField($domainUrl, "flag", $this->__("backend.domainUrl.properties.flag"), array("fr" => "French flag", "en" => "US Flag", "ro" => "Romanian flag")) ?>
                </div>
                <div class="col-md-3">
                    <?= $this->helper("Wizard")->textField($domainUrl, "code", $this->__("backend.domainUrl.properties.code")) ?>
                </div>
                <div class="col-md-3">
                    <?= $this->helper("Wizard")->selectField($domainUrl, "is_alias", $this->__("backend.domainUrl.properties.isAlias"), array(0 => "No", 1 => "Yes")) ?>
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