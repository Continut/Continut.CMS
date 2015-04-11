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
			<button type="button" class="btn btn-default"><i class="fa fa-fw fa-eye"></i> Page active</button>
			<button type="button" class="btn btn-default"><i class="fa fa-fw fa-check"></i> Page shown in menu</button>
			<button type="button" class="btn btn-danger"><i class="fa fa-fw fa-trash"></i> Delete page</button>
		</div>
	</div>
	<div class="col-sm-4">

	</div>
</div>
<div class="panel panel-warning page-panel">
	<div class="panel-heading"><i class="fa fa-fw fa-file-o"></i> <?= $page->getTitle() ?></div>
	<div class="panel-body">
		<?= $containers ?>
	</div>
</div>
<script type="text/javascript">
	$('.page-link').on('click', function() {
		$.ajax({
			url: '<?= $this->link(["_extension" => "Backend", "_controller" => "Index", "_action" => "pageShow"]) ?>',
			data: { page_uid: $(this).data('page-uid') }
		})
			.done(function( data ) {
				$('#content').html(data);
			});
	});
</script>