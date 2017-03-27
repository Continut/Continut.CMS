<a class="thumbnail text-center quick-link" role="button">
    <span class="icon <?= $this->valueOrDefault('icon', 'icon-phone') ?>"></span>
    <?php if ($this->getVariable('title')): ?>
        <h2><?= $title ?></h2>
    <?php endif; ?>
    <?php if ($this->getVariable('text')): ?>
        <p><?= $text ?></p>
    <?php endif; ?>
</a>
