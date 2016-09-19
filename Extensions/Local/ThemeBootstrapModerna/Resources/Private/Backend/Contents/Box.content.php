<div class="box">
    <div class="text-center">
        <?php if ($icon): ?>
            <p><i class="<?= $icon ?>"></i></p>
        <?php endif ?>
        <?= $this->helper('Text')->truncate($this->helper('Text')->stripTags($content), 100) ?>
    </div>
    <?php if ($link): ?>
        <div
            style="background: dodgerblue; padding: 10px; text-align: center; color: white"><?= $this->__("backend.themeBootstrapModerna.content.box.learn.more") ?></div>
    <?php endif ?>
</div>