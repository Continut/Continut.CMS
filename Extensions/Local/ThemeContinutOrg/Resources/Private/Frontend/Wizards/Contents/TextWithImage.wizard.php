<div class="form-group">
    <?= $this->helper('Wizard')->textField('title', 'Title', $this->valueOrDefault('title', '')) ?>
</div>
<div class="form-group">
    <?= $this->helper('Wizard')->rteField('content', 'Content', $this->valueOrDefault('content', '')) ?>
</div>