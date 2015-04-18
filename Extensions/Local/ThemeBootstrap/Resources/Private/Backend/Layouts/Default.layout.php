<div class="row">
	<div class="col-sm-12">
		<div class="panel panel-success">
			<div class="panel-heading">
				<div class="panel-title">
					<?= $this->__("backend.themeBootstrap.layout.container.header") ?>
				</div>
			</div>
			<div class="panel-body">
				<div class="content-drag-receiver"></div>
				<?php $this->showContainerColumn(1); ?>
				<a class="btn btn-sm btn-success" href=""><i class="fa fa-plus fa-fw"></i> <?= $this->__("backend.content.addNew") ?></a>
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
				<?php $this->showContainerColumn(2); ?>
				<a class="btn btn-sm btn-success" href=""><i class="fa fa-plus fa-fw"></i> <?= $this->__("backend.content.addNew") ?></a>
			</div>
		</div>
	</div>
	<div class="col-sm-6">
		<div class="panel panel-success">
			<div class="panel-heading">
				<div class="panel-title"><?= $this->__("backend.themeBootstrap.layout.container.rightColumn") ?></div>
			</div>
			<div class="panel-body">
				<?php $this->showContainerColumn(3); ?>
				<a class="btn btn-sm btn-success" href=""><i class="fa fa-plus fa-fw"></i> <?= $this->__("backend.content.addNew") ?></a>
			</div>
		</div>
	</div>
</div>