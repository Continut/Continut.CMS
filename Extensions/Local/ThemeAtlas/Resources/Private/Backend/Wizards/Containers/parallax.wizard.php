<div class="form-group">
    <?= $this->helper('Wizard')->textField('title', $this->__('backend.wizard.title'), $this->valueOrDefault('title', '')) ?>
</div>
<div class="form-group">
    <?= $this->helper('Wizard')->textField('image', $this->__('backend.wizard.image'), $this->valueOrDefault('image', null)) ?>
</div>