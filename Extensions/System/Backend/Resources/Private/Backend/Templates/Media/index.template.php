<div class="panel panel-default panel-media">
	<div class="panel-heading">
		<div class="row">
			<div class="col-sm-3">
				<h2 class="title">Media</h2>
			</div>
			<div class="col-sm-9">
				<div class="row">
					<div class="col-sm-6">
						<form class="form-inline">
							<input type="text" class="form-control" placeholder="Search">
						</form>
					</div>
					<div class="col-sm-6">
						<div class="btn-group pull-right" role="group" aria-label="Thumbnail display">
							<button type="button" class="btn btn-default"><i class="fa fa-fw fa-bars"></i></button>
							<button type="button" class="btn btn-default"><i class="fa fa-fw fa-th"></i></button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="panel-body">
		<div class="row">
			<div class="col-sm-3">
				<div class="btn-group btn-group-justified" role="group" aria-label="...">
					<div class="btn-group" role="group">
						<a class="btn btn-success" id="create_folder" href="<?= $this->helper("Url")->linkToAction("Backend", "Media", "createFolder", array("path" => urlencode($path))) ?>"><?= $this->__("backend.media.folders.create") ?> <i class="fa fa-fw fa-plus"></i></a>
					</div>
					<div class="btn-group" role="group">
						<a class="btn btn-primary"><?= $this->__("backend.media.files.upload") ?> <i class="fa fa-fw fa-upload"></i></a>
					</div>
				</div>
				<div class="list-group folders-list" id="folders_menu">
					<h4><?= $this->__("backend.media.folders.subfolders") ?></h4>
					<?php if ($path != ""): ?>
						<a class="list-group-item list-group-item-info" href="<?= $path ?>"><span class="badge"><i class="fa fa-angle-double-up"></i></span> <?= $this->__("backend.media.folders.up") ?></a>
					<?php endif ?>
					<?php foreach ($folders as $folder): ?>
						<a class="list-group-item" href="<?= $this->helper("Url")->linkToAction("Backend", "Media", "index", array("path" => urlencode($folder->getRelativePath()) )) ?>"><span class="badge"><?= $folder->getCountFolders() ?> <i class="fa fa-fw fa-folder"></i> / <?= $folder->getCountFiles() ?> <i class="fa fa-fw fa-file"></i></span> <?= $folder->getName() ?></a>
					<?php endforeach ?>
				</div>
			</div>
			<div class="col-sm-9">
				<p><small><?= $path ?></small></p>
				<?php if ($files): ?>
				<div class="row">
					<?php foreach ($files as $file): ?>
						<div class="col-xs-6 col-md-2">
							<a href="#" class="thumbnail">
								<?php if ($file->getExtension() == "JPG"): ?>
									<img src="<?= $this->helper("Image")->resize($file->getRelativeFilename(), 100, 100, "storage") ?>" alt=""/>
								<?php else: ?>
									<span class="extension"><?= $file->getExtension() ?></span>
									<i class="fa fa-file" style="font-size: 100px"></i>
								<?php endif; ?>
								<div class="caption">
									<p><?= $file->getFullname(); ?><br/>
									<?= $this->helper("Units")->formatBytes($file->getSize()); ?></p>
								</div>
							</a>
						</div>
					<?php endforeach ?>
				</div>
				<?php else: ?>
					<div class="alert alert-warning" role="alert">
						<p><?= $this->__("backend.media.files.missing") ?></p>
					</div>
				<?php endif; ?>
			</div>
		</div>
	</div>
</div>

<script>
	$('#create_folder').on('click', function(event) {
		event.preventDefault();
		var path = $(this).attr('href');
		BootstrapDialog.confirm({
			message: '<?= preg_replace('/[\r\n]+/', null, $this->partial("Backend", "Backend", "Media/createDirectory")) ?>',
			title: '<?= $this->__("backend.media.folders.create") ?>',
			type: BootstrapDialog.TYPE_SUCCESS,
			callback: function(result) {
				// if user confirms, send delete request
				if(result) {
					$.getJSON(path, {
						folder: $('#folder').val()
					}).done(function (data) {
						console.log(data);
					});
				}
			}
		});
	});

	$('#folders_menu .list-group-item').on('click', function(event) {
		event.preventDefault();
		var path = $(this).attr('href');
		$.get(path).done(function (data) {
			$('#container').html(data);
		});
	});
</script>