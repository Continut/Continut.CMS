<div class="form-group">
    <?= $this->helper('Form')->textField('title', $this->__('backend.wizard.title'), $this->valueOrDefault('title', '')) ?>
</div>
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <?= $this->helper('Form')->selectField(
                'icon',
                'Icon',
                [
                    'fa-tablet'      => 'Tablet',
                    'fa-bars'        => 'Bars',
                    'fa-folder'      => 'Folder',
                    'fa-gear'        => 'Gear',
                    'fa-lightbulb-o' => 'Lightbulb'
                ], $this->valueOrDefault('icon', 'fa-tablet')
            ) ?>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <?= $this->helper('Form')->selectField(
                'align',
                'Text alignment',
                [
                    'text-left'   => 'Left',
                    'text-center' => 'Center',
                    'text-right'  => 'Right'
                ],
                $this->valueOrDefault('align', 'text-left')
            ) ?>
        </div>
    </div>
</div>
<div class="form-group">
    <?= $this->helper('Form')->textareaField('subtitle', 'Content', $this->valueOrDefault('subtitle', '')) ?>
</div>