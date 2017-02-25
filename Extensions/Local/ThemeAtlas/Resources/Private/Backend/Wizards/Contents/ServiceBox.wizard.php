<div class="form-group">
    <?= $this->helper('Wizard')->textField('title', $this->__('backend.wizard.title'), $this->valueOrDefault('title', '')) ?>
</div>
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <?= $this->helper('Wizard')->selectField(
                'icon',
                'Icon',
                [
                    'fa fa-lightbulb-o alignleft' => 'Lightbulb',
                    'fa fa-laptop alignleft'      => 'Laptop',
                    'fa fa-headphones alignleft'  => 'Headphones',
                    'fa fa-mobile alignleft'      => 'Mobile phone'
                ],
                $this->valueOrDefault('icon', 'fa fa-lightbulb-o alignleft')
            ) ?>
        </div>
    </div>
</div>
<div class="form-group">
    <?= $this->helper('Wizard')->rteField('content', 'Content', $this->valueOrDefault('content', '')) ?>
</div>