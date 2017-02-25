<div class="form-group">
    <?= $this->helper('Wizard')->textField('title', $this->__('backend.wizard.title'), $this->valueOrDefault('title', '')) ?>
</div>
<div class="form-group">
    <?= $this->helper('Wizard')->textField('subheader', 'Subheader', $this->valueOrDefault('subheader', '')) ?>
</div>