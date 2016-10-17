<div class="form-group">
    <?= $this->helper('Wizard')->textField("title", $this->__('backend.wizard.title'), $this->valueOrDefault('title', '')) ?>
</div>
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <?= $this->helper('Wizard')->selectField(
                'icon',
                'Icon',
                [
                    'fa-user'   => 'User',
                    'fa-coffee' => 'Coffee',
                    'fa-trophy' => 'Trophy',
                    'fa-camera' => 'Camera'
                ],
                $this->valueOrDefault('icon', 'fa-user')
            ) ?>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <?= $this->helper('Wizard')->selectField(
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
    <?= $this->helper('Wizard')->textField('subtitle', 'Content', $this->valueOrDefault('subtitle', '')) ?>
</div>