<div <?php echo $this->getAdditionalData(); ?>>
    <?php if ($title): ?>
        <h1><?= $title ?></h1>
    <?php endif ?>
    <?= $content ?>
</div>