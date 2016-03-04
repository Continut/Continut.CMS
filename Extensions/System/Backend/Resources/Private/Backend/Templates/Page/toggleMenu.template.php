<?php if ($page->getIsInMenu()) : ?>
    <i class="fa fa-fw fa-eye"></i> <?= $this->__("backend.page.visibleInMenu") ?>
<?php else: ?>
    <i class="fa fa-fw fa-eye-slash text-danger"></i> <?= $this->__("backend.page.notVisibleInMenu") ?>
<?php endif; ?>