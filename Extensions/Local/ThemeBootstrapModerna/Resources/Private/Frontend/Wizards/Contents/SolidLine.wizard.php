<div class="form-group">
    <?= $this->helper('Wizard')->textField('title', $this->__('backend.wizard.title'), $this->valueOrDefault('title', '')) ?>
</div>
<div class="form-group">
    <?= $this->helper('Wizard')->selectField(
        'lineType',
        'Line type',
        [
            'solid' => 'Solid',
            'dashed' => 'Dashed',
            'dotted' => 'Dotted'
        ],
        $this->valueOrDefault('lineType', 'solid')
    ) ?>
</div>