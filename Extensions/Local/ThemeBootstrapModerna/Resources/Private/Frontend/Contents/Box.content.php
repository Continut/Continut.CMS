<div class="box" <?php echo $this->getAdditionalData(); ?>>
    <div class="box-gray aligncenter">
        <?php if ($title): ?>
            <h4><?= $title ?></h4>
        <?php endif ?>
        <?php if ($icon): ?>
            <div class="icon"><i class="<?= $icon ?>"></i></div>
        <?php endif ?>
        <?= $content ?>
    </div>
    <?php if ($link): ?>
        <div class="box-bottom"><a
                href="<?= $this->helper("Url")->linkToPage($link) ?>"><?= $this->__("box.learn.more") ?></a></div>
    <?php endif ?>
</div>