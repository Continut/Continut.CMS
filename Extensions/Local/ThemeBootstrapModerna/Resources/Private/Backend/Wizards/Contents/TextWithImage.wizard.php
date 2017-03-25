<div class="form-group">
    <?= $this->helper('Form')->textField('title', 'Title', $this->valueOrDefault('title', '')) ?>
</div>
<div class="form-group">
    <?= $this->helper('Form')->rteField('content', 'Content', $this->valueOrDefault('content', '')) ?>
</div>