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
				<p><a class="btn btn-success"><?= $this->__("backend.media.folders.create") ?> <i class="fa fa-fw fa-plus"></i></a></p>
				<div class="list-group">
					<?php if ($path != ""): ?>
						<a class="list-group-item" href="<?= $path ?>"> <?= $this->__("backend.media.folders.up") ?></a>
					<?php endif ?>
					<?php foreach ($folders as $folder): ?>
						<a class="list-group-item" href="<?= $folder->getAbsolutePath() ?>"><span class="badge"><?= $folder->getCountFolders() ?> <i class="fa fa-fw fa-folder"></i> / <?= $folder->getCountFiles() ?> <i class="fa fa-fw fa-file"></i></span> <?= $folder->getName() ?></a>
					<?php endforeach ?>
				</div>
			</div>
			<div class="col-sm-9">
				<div class="row">
					<?php if ($files): ?>
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
										<?= $file->getSize(); ?> bytes</p>
									</div>
								</a>
							</div>
						<?php endforeach ?>
					<?php else: ?>
						<p><?= $this->__("backend.media.files.missing") ?></p>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</div>
</div>