<div class="form-group">
    <?= $this->helper('Wizard')->textField("title", $this->__("backend.wizard.title"), $this->valueOrDefault('title')) ?>
</div>
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <?= $this->helper('Wizard')->selectField(
                'icon',
                'Icon',
                [
                    'fa fa-code fa-3x'      => 'Code',
                    'fa fa-pagelines fa-3x' => 'Pagelines',
                    'fa fa-edit fa-3x'      => 'Edit',
                    'fa fa-desktop fa-3x'   => 'Desktop'
                ],
                $this->valueOrDefault('icon', 'fa fa-code fa-3x')
            ) ?>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <?= $this->helper('Wizard')->textField('link', 'Link', $this->valueOrDefault('link', '')) ?>
        </div>
    </div>
</div>
<div class="form-group">
    <?= $this->helper('Wizard')->rteField('content', 'Content', $this->valueOrDefault('content', '')) ?>
</div>