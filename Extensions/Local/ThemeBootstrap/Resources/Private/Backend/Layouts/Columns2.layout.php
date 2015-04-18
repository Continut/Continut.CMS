		<div class="row">
			<div class="col-sm-8">
				<div class="panel panel-default">
					<div class="panel-heading">
						<div class="panel-title"><?= $this->__("backend.themeBootstrap.layout.container.leftColumn") ?></div>
					</div>
					<div class="panel-body">
						<?php $this->showContainerColumn(1); ?>
						<a class="btn btn-sm btn-success" href=""><i class="fa fa-plus fa-fw"></i></a>
					</div>
				</div>
			</div>
			<div class="col-sm-4">
				<div class="panel panel-default">
					<div class="panel-heading">
						<div class="panel-title"><?= $this->__("backend.themeBootstrap.layout.container.rightColumn") ?></div>
					</div>
					<div class="panel-body">
						<?php $this->showContainerColumn(2); ?>
						<a class="btn btn-sm btn-success" href=""><i class="fa fa-plus fa-fw"></i></a>
					</div>
				</div>
			</div>
		</div>
