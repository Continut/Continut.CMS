<div <?php echo $this->getAdditionalData(); ?>>
    <?php if ($title): ?>
        <h4><?= $title ?></h4>
    <?php endif ?>
    <?= $content ?>
</div>