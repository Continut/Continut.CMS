<?php
    $links = 2;
    $last  = ceil($grid->getTotalRecords() / $grid->getLimit());
    $start = (($grid->getPage() - $links ) > 0 ) ? $grid->getPage() - $links : 1;
    $end   = (($grid->getPage() + $links ) < $last ) ? $grid->getPage() + $links : $last;
?>
<p><?= $this->__("backend.grid.form.resultsCount", ["count" => $grid->getTotalRecords()]) ?></p>
<?php if ($last > 1): ?>
<nav>
    <ul class="pagination">
        <?php if ($grid->getPage() > 1): ?>
            <li><a aria-label="<?= $this->__("backend.paginator.page.first") ?>" href="<?= $grid->getFormAction() ?>&page=1"><span aria-hidden="true" class="fa fa-icon fa-arrow-left"></span> <?= $this->__("backend.paginator.page.first") ?></a></li>
            <li><a aria-label="<?= $this->__("backend.paginator.page.previous") ?>" href="<?= $grid->getFormAction() ?>&page=<?= ($grid->getPage() - 1) ?>"><span aria-hidden="true" class="fa fa-icon fa-arrow-circle-o-left"></span> <?= $this->__("backend.paginator.page.previous") ?></a></li>
        <?php endif ?>
        <?php for ($i = $start; $i <= $end; $i++): ?>
            <?php if ($grid->getPage() == $i): ?>
                <li class="active"><a href="#"><?= $i ?></a></li>
            <?php else: ?>
                <li><a href="<?= $grid->getFormAction() ?>&page=<?= $i ?>"><?= $i ?></a></li>
            <?php endif ?>
        <?php endfor ?>
        <?php if ($grid->getPage() < $last): ?>
            <li><a aria-label="<?= $this->__("backend.paginator.page.next") ?>" href="<?= $grid->getFormAction() ?>&page=<?= ($grid->getPage() + 1) ?>"><?= $this->__("backend.paginator.page.next") ?> <span aria-hidden="true" class="fa fa-icon fa-arrow-circle-o-right	"></span></a></li>
            <li><a aria-label="<?= $this->__("backend.paginator.page.last") ?>" href="<?= $grid->getFormAction() ?>&page=<?= ($last) ?>"><?= $this->__("backend.paginator.page.last") ?> <span aria-hidden="true" class="fa fa-icon fa-arrow-right"></span></a></li>
        <?php endif ?>
    </ul>
</nav>
<?php endif ?>