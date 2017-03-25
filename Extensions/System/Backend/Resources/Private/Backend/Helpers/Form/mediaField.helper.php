<div class="form-group field-type-media">
    <?= $fieldLabel ?>
    <input id="<?= $fieldId ?>" type="hidden" value="<?= $value ?>" name="<?= $fieldName ?>"/>
    <?php foreach ($values as $image): ?>
    <div class="media">
        <div class="media-left">
            <?php // @TODO: check if image, else no preview ?>
            <img class="media-object" src="<?= $this->helper('Image')->crop($image, 80, 80, 'backend_wizard') ?>" alt=""/>
        </div>
        <div class="media-body">
            <a title="Remove image" href="#" class="btn pull-right btn-danger"><span class="fa fa-fw fa-trash"></span></a>
            <h4 class="media-heading"><?= $image ?></h4>
            Filename, filesize
        </div>
    </div>
    <?php endforeach ?>
    <?php if (sizeof($values) == 0 || (isset($arguments['maxFiles']) && sizeof($values) < $arguments['maxFiles'])): ?>
        <p><a href="#" class="btn btn-success"><i class="fa fa-fw fa-plus"></i> <?= $this->__('backend.media.wizard.addFiles') ?></a></p>
    <?php endif; ?>
</div>