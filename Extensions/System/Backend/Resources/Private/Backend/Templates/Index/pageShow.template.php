<div class="row">
	<div class="col-sm-12">
		<ol class="breadcrumb breadcrumb-page-tree">
			<?php foreach ($breadcrumbs as $breadcrumb): ?>
				<li><a class="page-link" href="#" data-page-uid="<?= $breadcrumb->getUid() ?>"><?= $breadcrumb->getTitle(); ?></a></li>
			<?php endforeach ?>
			<li class="active"><?= $page->getTitle() ?></li>
		</ol>
	</div>
</div>
<div class="row">
	<div class="col-sm-8">
		<div class="btn-group" role="group">
			<button type="button" class="btn btn-default" id="page-visibility-frontend">
				<?php if ($page->getIsVisible()) : ?>
					<i class="fa fa-fw fa-check"></i> <?= $this->__("backend.page.visibleInFrontend") ?>
				<?php else: ?>
					<i class="fa fa-fw fa-close text-danger"></i> <?= $this->__("backend.page.notVisibleInFrontend") ?>
				<?php endif ?>
			</button>
			<button type="button" class="btn btn-default" id="page-visibility-menu">
				<?php if ($page->getIsInMenu()) : ?>
					<i class="fa fa-fw fa-eye"></i> <?= $this->__("backend.page.visibleInMenu") ?>
				<?php else: ?>
					<i class="fa fa-fw fa-eye-slash text-danger"></i> <?= $this->__("backend.page.notVisibleInMenu") ?>
				<?php endif; ?>
			</button>
			<button type="button" class="btn btn-default" id="page-refresh">
				<i class="fa fa-fw fa-refresh"></i> <?= $this->__("backend.page.refresh") ?>
			</button>
		</div>
	</div>
	<div class="col-sm-4">
		<div class="btn-group pull-right" role="group">
			<button type="button" class="btn btn-danger"><i class="fa fa-fw fa-trash"></i> <?= $this->__("backend.page.deletePage") ?></button>
		</div>
	</div>
</div>
<div class="panel panel-warning page-panel">
	<div class="panel-heading"><i class="fa fa-fw fa-file-o"></i> <?= $page->getTitle() ?></div>
	<div class="panel-body">
		<?= $pageContent ?>
	</div>
</div>
<script type="text/javascript">
	$('.page-link').on('click', function() {
		$.ajax({
			url: '<?= $this->helper("Url")->linkToAction("Backend", "Index", "pageShow") ?>',
			data: { page_uid: $(this).data('page-uid') }
		})
		.done(function( data ) {
			$('#content').html(data);
		});
	});
	$('#page-visibility-frontend').on('click', function() {
		$.ajax({
			url: '<?= $this->helper("Url")->linkToAction("Backend", "Index", "pageToggleVisibility") ?>',
			data: { page_uid: <?= $page->getUid() ?> }
		})
			.done(function( data ) {
				$('#page-visibility-frontend').html(data);
			});
	});
	$('#page-visibility-menu').on('click', function() {
		$.ajax({
			url: '<?= $this->helper("Url")->linkToAction("Backend", "Index", "pageToggleMenu") ?>',
			data: { page_uid: <?= $page->getUid() ?> }
		})
			.done(function( data ) {
				$('#page-visibility-menu').html(data);
			});
	});
</script>