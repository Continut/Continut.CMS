<div class="row">
    <?= $this->partial('Settings/leftMenu', 'Backend', 'Backend', ['data' => $data]); ?>
    <div class="col-sm-12 col-md-9">
        <h3><?= $this->__('backend.settings.media.title') ?></h3>
    </div>
</div>

<script>
    $('#settings_menu_1').collapse('show');
</script>
