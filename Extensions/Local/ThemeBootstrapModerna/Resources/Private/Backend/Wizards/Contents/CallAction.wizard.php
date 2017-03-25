<div class="form-group">
    <?= $this->helper('Form')->textField('title', $this->__('backend.wizard.title'), $this->valueOrDefault('title', '')) ?>
</div>
<div class="form-group">
    <?= $this->helper('Form')->textField('subheader', 'Subheader', $this->valueOrDefault('subheader', '')) ?>
</div>