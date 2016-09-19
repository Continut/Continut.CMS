<div class="service-box">
    <?php if ($icon): ?>
        <div class="service-border"><i class="<?= $icon ?>"></i></div>
    <?php endif ?>
    <?php if ($title): ?>
        <h3><?= $title ?></h3>
    <?php endif ?>
    <p><?= $content ?></p>
</div>