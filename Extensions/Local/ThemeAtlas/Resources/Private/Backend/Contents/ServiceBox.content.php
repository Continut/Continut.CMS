<div>
    <?php if ($icon): ?>
        <p><i class="<?= $icon ?>"></i></p>
    <?php endif ?>
    <div class="text-center">
        <?= $this->helper('Text')->truncate($this->helper('Text')->stripTags($content), 100) ?>
    </div>
</div>