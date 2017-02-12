<form method="POST" id="content_edit"
      action="<?= $this->helper("Url")->linkToPath('admin_backend', ['_controller' => 'Settings', '_action' => 'saveDomainUrl', 'id' => $domainUrl->getId()]) ?>">
    <?= $this->helper('FormObject')->hiddenField($domainUrl, 'id', $domainUrl->getId()); ?>
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
                    <?= $this->helper('FormObject')->textField($domainUrl, "title", $this->__("backend.domainUrl.properties.title")) ?>
                </div>
                <div class="col-md-3">
                    <?= $this->helper('FormObject')->selectField($domainUrl, "domain_id", $this->__("backend.domainUrl.properties.domainId"), $domains->toSelect('id', 'title'), $domainUrl->getDomainId()) ?>
                </div>
                <div class="col-md-6">
                    <?= $this->helper('FormObject')->textField($domainUrl, "url", $this->__("backend.domainUrl.properties.url"), $domainUrl->getUrl(), ["prefix" => "http://"]) ?>
                </div>
                <div class="col-md-3">
                    <?= $this->helper('FormObject')->textField($domainUrl, "locale", $this->__("backend.domainUrl.properties.locale")) ?>
                </div>
                <div class="col-md-3">
                    <?= $this->helper('FormObject')->selectField($domainUrl, "flag", $this->__("backend.domainUrl.properties.flag"), $this->helper('Locale')->iso2LanguageCodes()) ?>
                </div>
                <div class="col-md-3">
                    <?= $this->helper('FormObject')->textField($domainUrl, "code", $this->__("backend.domainUrl.properties.code")) ?>
                </div>
                <div class="col-md-3">
                    <?= $this->helper('FormObject')->selectField($domainUrl, "is_alias", $this->__("backend.domainUrl.properties.isAlias"), [0 => $this->__("general.no"), 1 => $this->__("general.yes")]) ?>
                </div>
                <p>Aliases defined for this domain <a href="">(what is an alias?)</a>:</p>
                <?php if($domainUrl->getAliases()): ?>
                <div class="col-md-3">
                    <?php foreach ($domainUrl->getAliases() as $alias): ?>
                        <div class="form-group ">
                            <label class="control-label" for="field_alias_<?= $alias->getId() ?>">Alias</label>
                            <input id="field_alias_<?= $alias->getId() ?>" type="text" class="form-control" value="<?= $alias->getUrl()?>" name="data[alias][<?= $alias->getId() ?>]">
                        </div>
                    <?php endforeach; ?>
                    <a class="btn btn-success">Add new alias</a>
                </div>
                <?php endif; ?>
            </div>
            <div class="panel-footer">
                <input type="submit" name="submit" class="btn btn-primary"
                       value="<?= $this->__("general.save") ?>"/>
                <a class="close-button btn btn-danger pull-right"><?= $this->__("general.cancel") ?></a>
            </div>
        </div>
    </div>
</form>