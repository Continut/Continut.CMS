<?php if ($page->getIsVisible()) : ?>
	<i class="fa fa-fw fa-check"></i> <?= $this->__("backend.page.visibleInFrontend") ?>
<?php else: ?>
	<i class="fa fa-fw fa-close text-danger"></i> <?= $this->__("backend.page.notVisibleInFrontend") ?>
<?php endif ?>