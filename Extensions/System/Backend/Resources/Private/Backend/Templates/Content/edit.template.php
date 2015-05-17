<div class="row">
	<div class="col-sm-12">
		<ol class="breadcrumb breadcrumb-page-tree">
			<li class="active"><?= $this->__("backend.content.type." . $element->getType()) ?></li>
			<li>
				<?php if (!$element->getTitle()): ?>
					<?= $this->__("backend.content.noTitle") ?>
				<?php else: ?>
					<?= $element->getTitle() ?>
				<?php endif ?>
				(<?= $element->getUid() ?>)
			</li>
		</ol>
	</div>
</div>
<?= $this->partial("Backend", "Backend", "Content/editArea") ?>
<div class="row">
	<div class="col-sm-12">
		<form method="post" id="form_content" class="form-content">
			<?= $content ?>
		</form>
	</div>
</div>
<?= $this->partial("Backend", "Backend", "Content/editArea") ?>