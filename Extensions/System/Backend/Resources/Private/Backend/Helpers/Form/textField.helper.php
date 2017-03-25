<div class="form-group">
    <?= $fieldLabel ?>
    <?php if (isset($arguments['prefix'])): ?>
        <?php $prefix = $arguments['prefix']; ?>
        <div class="input-group">
            <span class="input-group-addon"><?= $prefix ?></span>
            <input id="<?= $fieldId ?>" type="text" class="form-control" value="<?= $value ?>" name="<?= $fieldName ?>"/>
        </div>
    <?php else: ?>
        <input id="<?= $fieldId ?>" type="text" class="form-control" value="<?= $value ?>" name="<?= $fieldName ?>"/>
    <?php endif; ?>
</div>