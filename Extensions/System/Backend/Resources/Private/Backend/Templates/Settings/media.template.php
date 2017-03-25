<div class="row">
    <?= $this->partial('Settings/leftMenu', 'Backend', 'Backend', ['data' => $data]); ?>
    <div class="col-sm-12 col-md-9">
        <h3><?= $this->__('backend.settings.media.title') ?></h3>

        <form method="POST"
              id="content_edit"
              action="<?= $this->helper("Url")->linkToPath('admin_backend', ['_controller' => 'Settings', '_action' => 'saveSettings']) ?>">
            <div class="panel panel-warning">
                <div class="panel-heading">
                    <div class="panel-title">
                        Microsoft OneDrive
                    </div>
                </div>
                <div class="panel-body">
                    <div class="col-md-3">
                        <?= $this->helper('Form')->textField('OneDrive/Client/Name', 'Storage Name', (isset($data['config']['OneDrive/Client/Name'])) ? $data['config']['OneDrive/Client/Name'] : 'ContinutCMS OneDrive Test') ?>
                    </div>
                    <div class="col-md-3">
                        <?= $this->helper('Form')->textField('OneDrive/Client/Id', 'App Id/Client Id', (isset($data['config']['OneDrive/Client/Id'])) ? $data['config']['OneDrive/Client/Id'] : '') ?>
                    </div>
                </div>
                <div class="panel-footer">
                    <input type="submit" name="submit" class="btn btn-primary" value="<?= $this->__('general.save') ?>"/>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    $('#settings_menu_1').collapse('show');
</script>
