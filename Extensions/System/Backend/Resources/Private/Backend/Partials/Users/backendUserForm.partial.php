<form method="POST" id="page_edit_template"
      action="<?= $this->helper('Url')->linkToPath('admin', ['_controller' => 'Users', '_action' => 'saveBackendUser']) ?>">
    <?= $this->helper('FormObject')->hiddenField($user, 'id', $user->getId()); ?>
    <div class="col-sm-12">
        <div class="panel panel-warning">
            <div class="panel-heading">
                <div class="panel-title">
                    <?= $this->__('backend.backendUser.properties.header') ?>
                </div>
            </div>
            <div class="panel-body">
                <div class="col-sm-6 col-xs-12">
                    <div class="form-group">
                        <?= $this->helper('FormObject')->textField($user, 'name', $this->__('backend.backendUser.properties.name')) ?>
                    </div>
                    <div class="form-group">
                        <?= $this->helper('FormObject')->textField($user, 'username', $this->__('backend.backendUser.properties.username')) ?>
                    </div>
                </div>
                <div class="col-sm-6 col-xs-12">
                    <div class="form-group">
                        <?= $this->helper('FormObject')->selectField($user, 'usergroup', $this->__('backend.backendUser.properties.usergroupId'), $backendUsergroups) ?>
                    </div>
                    <div class="form-group">
                        <?= $this->helper('FormObject')->textField($user, 'password', $this->__('backend.backendUser.properties.password')) ?>
                    </div>
                </div>
            </div>
            <div class="panel-footer">
                <input type="submit" name="submit" class="btn btn-primary"
                       value="<?= $this->__('general.save') ?>"/>
                <a class="close-button btn btn-danger pull-right"><?= $this->__('general.cancel') ?></a>
            </div>
        </div>
    </div>
</form>