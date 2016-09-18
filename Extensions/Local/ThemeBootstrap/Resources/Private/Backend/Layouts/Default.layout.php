<div class="row">
	<div class="col-sm-12">
		<div class="panel panel-success">
			<div class="panel-heading">
				<div class="panel-title">
					<?= $this->__("backend.themeBootstrap.layout.container.header") ?>
				</div>
			</div>
			<div class="panel-body">
				<?= $this->showContainerColumn(1); ?>
				<a class="btn btn-sm btn-success content-wizard" title="<?= $this->__("backend.content.addNew") ?>" href=""><i class="fa fa-plus fa-fw"></i></a>
			</div>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-sm-6">
		<div class="panel panel-success">
			<div class="panel-heading">
				<div class="panel-title"><?= $this->__("backend.themeBootstrap.layout.container.leftColumn") ?></div>
			</div>
			<div class="panel-body">
				<?= $this->showContainerColumn(2); ?>
				<a class="btn btn-sm btn-success content-wizard" title="<?= $this->__("backend.content.addNew") ?>" href=""><i class="fa fa-plus fa-fw"></i></a>
			</div>
		</div>
	</div>
	<div class="col-sm-6">
		<div class="panel panel-success">
			<div class="panel-heading">
				<div class="panel-title"><?= $this->__("backend.themeBootstrap.layout.container.rightColumn") ?></div>
			</div>
			<div class="panel-body">
				<?= $this->showContainerColumn(3); ?>
				<a class="btn btn-sm btn-success content-wizard" title="<?= $this->__("backend.content.addNew") ?>" href=""><i class="fa fa-plus fa-fw"></i></a>
			</div>
		</div>
	</div>
</div>