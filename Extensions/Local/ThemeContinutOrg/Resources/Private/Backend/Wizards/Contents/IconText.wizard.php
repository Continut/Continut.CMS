<div class="form-group">
    <?= $this->helper('Form')->selectField(
        'icon',
        'Icon',
        [
            'icon-phone' => 'Phone',
            'icon-love' => 'Heart',
            'icon-thumbs-up' => 'Thumbs up'
        ],
        $this->valueOrDefault('icon', '')
    ) ?>
</div>
<div class="form-group">
    <?= $this->helper('Form')->textField('title', 'Title', $this->valueOrDefault('title', '')) ?>
</div>
<div class="form-group">
    <?= $this->helper('Form')->textField('text', 'Text', $this->valueOrDefault('text', '')) ?>
</div>