<div class="form-group">
    <?= $this->helper('Wizard')->textField('title', $this->__('backend.content.wizard.title'), $this->valueOrDefault('title', '')) ?>
</div>
<div class="form-group">
    <?= $this->helper('Wizard')->textField('subtitle', $this->__('backend.content.wizard.subtitle'), $this->valueOrDefault('subtitle', '')) ?>
</div>