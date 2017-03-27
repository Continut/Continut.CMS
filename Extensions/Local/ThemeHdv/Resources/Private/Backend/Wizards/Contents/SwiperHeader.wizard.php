<?= $this->helper('Form')->mediaField('image', $this->__('backend.wizard.image'), $this->valueOrDefault('image', null), ['maxFiles' => 10]) ?>

<?= $this->helper('Form')->startRepeater('test') ?>
    <div data-type="template" style="display: none">
        <div class="col-xs-6">
             <?= $this->helper('Form')->textField('name', $this->__('backend.wizard.text'), $this->valueOrDefault('name', '')) ?>
        </div>
        <div class="col-xs-6">
            <?= $this->helper('Form')->textField('email', $this->__('backend.wizard.email'), $this->valueOrDefault('email', '')) ?>
        </div>
    </div>
<?php var_dump($repeater); ?>
<?= $this->helper('Form')->stopRepeater() ?>

<script type="text/javascript">
    $('div[data-type="repeater"]').each(function (index, object) {
        // add the repeater on click element creation
        var $repeater = $(this);
        var lastIndex = $repeater.find('.collapse').length;
        $(this).find('.add-repeater-element').on('click', function (event) {
            event.preventDefault();
            lastIndex++;
            $repeater.find('.panel-group').append('<div class="panel panel-default"><div class="panel-heading" role="tab" id="heading' + lastIndex + '"><h4 class="panel-title"><a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse' + lastIndex + '" aria-expanded="false" aria-controls="collapse' + lastIndex + '">Slide ' + lastIndex + ' </a></h4></div><div id="collapse' + lastIndex + '" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading' + lastIndex + '"> <div class="panel-body">' + $repeater.find('div[data-type="template"]').first().clone().show().html() + '</div></div></div>');
        });
    });
</script>
