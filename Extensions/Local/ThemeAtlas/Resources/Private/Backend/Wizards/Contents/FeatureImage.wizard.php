<div class="form-group">
    <?= $this->helper('Wizard')->textField('image', $this->__('backend.wizard.image'), $this->valueOrDefault('image', null)) ?>
</div>
<div class="row">
    <div class="col-md-3">
        <div class="form-group">
            <?= $this->helper('Wizard')->textField('width', $this->__('backend.wizard.width'), $this->valueOrDefault('width', 800)) ?>
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <?= $this->helper('Wizard')->textField('height', $this->__('backend.wizard.height'), $this->valueOrDefault('height', '')) ?>
        </div>
    </div>
</div>