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
				<span class="element-visible <?= $page->getIsVisible() ? "" : "hide" ?>"><i class="fa fa-fw fa-check"></i> <?= $this->__("backend.page.visibleInFrontend") ?></span>
				<span class="element-hide <?= $page->getIsVisible() ? "hide" : "" ?>"><i class="fa fa-fw fa-close text-danger"></i> <?= $this->__("backend.page.notVisibleInFrontend") ?></span>
			</button>
			<button type="button" class="btn btn-default" id="page-visibility-menu">
				<span class="element-visible <?= $page->getIsInMenu() ? "" : "hide" ?>"><i class="fa fa-fw fa-eye"></i> <?= $this->__("backend.page.visibleInMenu") ?></span>
				<span class="element-hide <?= $page->getIsInMenu() ? "hide" : "" ?>"><i class="fa fa-fw fa-eye-slash text-danger"></i> <?= $this->__("backend.page.notVisibleInMenu") ?></span>
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
			data: { page_uid: <?= $page->getUid() ?> },
			dataType: 'json'
		})
			.done(function( data ) {
				var node = $('#cms_tree').tree('getNodeById', data.pid);
				if (data.visible) {
					$('#page-visibility-frontend .element-visible').removeClass("hide");
					$('#page-visibility-frontend .element-hide').addClass("hide");
					$(node.element).find(".fa-lg").first().removeClass("fa-disabled");
				} else {
					$('#page-visibility-frontend .element-visible').addClass("hide");
					$('#page-visibility-frontend .element-hide').removeClass("hide");
					$(node.element).find(".fa-lg").first().addClass("fa-disabled");
				}
			});
	});
	$('#page-visibility-menu').on('click', function() {
		$.ajax({
			url: '<?= $this->helper("Url")->linkToAction("Backend", "Index", "pageToggleMenu") ?>',
			data: { page_uid: <?= $page->getUid() ?> },
			dataType: 'json'
		})
			.done(function( data ) {
				var node = $('#cms_tree').tree('getNodeById', data.pid);
				if (data.isInMenu) {
					$('#page-visibility-menu .element-visible').removeClass("hide");
					$('#page-visibility-menu .element-hide').addClass("hide");
					$(node.element).find(".fa-stack-1x").first().removeClass("fa-eye-slash text-danger");
				} else {
					$('#page-visibility-menu .element-visible').addClass("hide");
					$('#page-visibility-menu .element-hide').removeClass("hide");
					$(node.element).find(".fa-stack-1x").first().addClass("fa-eye-slash text-danger");
				}
			});
	});
	$('.content-wizard').on('click', function(e) {
		e.preventDefault();
		BootstrapDialog.show({
			title: '<?= $this->__("backend.content.wizard.create.title") ?>',
			message: $('<div></div>').load('<?= $this->helper("Url")->linkToAction("Backend", "Content", "wizard") ?>')
		})
	});
</script>