<select name="<?= $this->getField()->getName() ?>" class="form-control selectpicker">
    <?php if ($this->getValues()): ?>
        <?php foreach ($this->getValues() as $key => $value): ?>
            <?php $key = (string)$key; ?>
            <option value="<?= $key ?>" <?= ($key === $this->getField()->getValue()) ? "selected" : "" ?>><?= $value ?></option>
        <?php endforeach ?>
    <?php endif ?>
</select>