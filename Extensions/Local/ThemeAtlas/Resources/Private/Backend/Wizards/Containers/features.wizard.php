<blockquote>
    <p><i class="fa fa-fw fa-info"></i> <?= $this->__('backend.themeAtlas.wizard.container.features.info') ?></p>
    <footer><?= $this->__('backend.wizard.containers.info.footer') ?></footer>
</blockquote>
<div class="form-group">
    <?= $this->helper('Form')->textField('title', $this->__('backend.wizard.title'), $this->valueOrDefault('title', '')) ?>
</div>