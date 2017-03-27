<?= $this->helper('Form')->textField('title', $this->__('backend.wizard.title'), $this->valueOrDefault('title', '')) ?>
<div class="row">
    <div class="col-md-6">
        <?= $this->helper('Form')->textField('receiverEmail', 'Receiver email address', $this->valueOrDefault('receiverEmail', '')) ?>
    </div>
    <div class="col-md-6">
        <?= $this->helper('Form')->rteField('text', 'Text', $this->valueOrDefault('text', '')) ?>
    </div>
</div>