<?php
$widthRight = 12 - ($offsetRight + $offsetLeft);
?>
<section class="container-fluid container-content theme-<?= $theme ?>">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <h1>
                    <?= $title ?>
                    <?php if ($subtitle): ?><small><?= $subtitle ?></small><?php endif; ?>
                </h1>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12 col-sm-offset-<?= $offsetLeft ?> col-sm-<?= $widthRight ?>">
                <?= $this->showContainerColumn(4); ?>
            </div>
        </div>
    </div>
</section>