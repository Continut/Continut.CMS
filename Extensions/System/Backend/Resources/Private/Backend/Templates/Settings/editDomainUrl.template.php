<form method="POST" id="content_edit"
      action="<?= $this->helper("Url")->linkToPath('admin_backend', ['_controller' => 'Settings', '_action' => 'saveDomainUrl']) ?>">
    <?= $this->helper("Wizard")->hiddenField("id", $domainUrl->getId()); ?>
    <div class="col-sm-12">
        <div class="panel panel-warning">
            <div class="panel-heading">
                <div class="panel-title">
                    <?= $this->__("backend.domainUrl.properties.header") ?>
                </div>
            </div>
            <div class="panel-body">
                <div class="col-md-3">
                    <div class="form-group">
                        <?= $this->helper("Wizard")->textField("title", $this->__("backend.domainUrl.properties.title"), $domainUrl->getTitle()) ?>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <?= $this->helper("Wizard")->selectField("domain_id", $this->__("backend.domainUrl.properties.domainId"), $domains, $domainUrl->getDomainId()) ?>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <?= $this->helper("Wizard")->textField("url", $this->__("backend.domainUrl.properties.url"), $domainUrl->getUrl(), "http://") ?>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <?= $this->helper("Wizard")->textField("locale", $this->__("backend.domainUrl.properties.locale"), $domainUrl->getLocale()) ?>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <?= $this->helper("Wizard")->selectField("flag", $this->__("backend.domainUrl.properties.flag"), array("fr" => "French flag", "en" => "US Flag", "ro" => "Romanian flag"), $domainUrl->getFlag()) ?>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <?= $this->helper("Wizard")->textField("code", $this->__("backend.domainUrl.properties.code"), $domainUrl->getCode()) ?>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <?= $this->helper("Wizard")->selectField("is_alias", $this->__("backend.domainUrl.properties.isAlias"), array(0 => "No", 1 => "Yes"), $domainUrl->getIsAlias()) ?>
                    </div>
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