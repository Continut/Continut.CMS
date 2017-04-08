<div class="row">
    <?= $this->partial('Settings/leftMenu', 'Backend', 'Backend', ['data' => $data]); ?>
    <div class="col-sm-12 col-md-9">
        <h3><?= $this->__('backend.settings.session.title') ?></h3>

        <div class="panel panel-warning">
            <div class="panel-heading">
                <div class="panel-title">
                    <?= $this->__('backend.settings.session.frontend.header') ?>
                </div>
            </div>
            <div class="panel-body">
                <form method="POST"
                      id="content_edit"
                      action="<?= $this->helper("Url")->linkToPath('admin', ['_controller' => 'Settings', '_action' => 'saveSettings']) ?>">
                    <div class="col-md-3">
                        <?= $this->helper('Form')->textField('Session/Frontend/Duration', 'Session duration (in seconds)', (isset($data['config']['Session/Frontend/Duration'])) ? $data['config']['Session/Frontend/Duration'] : '') ?>
                    </div>
                </form>
            </div>
        </div>

    </div>
</div>

<script>
    $('#settings_menu_1').collapse('show');
</script>
