<div class="jumbotron <?= $class ?>">
    <div class="container">
        <?php if ($this->getVariable('title')): ?>
            <h1><?= $title ?></h1>
        <?php endif; ?>
        <?= $this->valueOrDefault('content', '') ?>
    </div>
</div>