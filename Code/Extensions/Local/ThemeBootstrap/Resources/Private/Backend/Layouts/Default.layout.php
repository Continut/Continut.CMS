<div class="row">
	<div class="col-sm-12">
		<div class="panel panel-default">
			<div class="panel-heading">Header <span class="pull-right"><a class="btn btn-xs btn-warning" href=""><i class="fa fa-pencil fa-fw"></i></a></span></div>
			<div class="panel-body">
				<div class="content-drag-receiver"></div>
				<?php $this->showContainerColumn(1); ?>
				<a class="btn btn-sm btn-success" href=""><i class="fa fa-plus fa-fw"></i></a>
			</div>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-sm-6">
		<div class="panel panel-default">
			<div class="panel-heading">
				<div class="panel-title">Left column</div>
			</div>
			<div class="panel-body">
				<?php $this->showContainerColumn(2); ?>
				<a class="btn btn-sm btn-success" href=""><i class="fa fa-plus fa-fw"></i></a>
			</div>
		</div>
	</div>
	<div class="col-sm-6">
		<div class="panel panel-default">
			<div class="panel-heading">
				<div class="panel-title">Right sidebar</div>
			</div>
			<div class="panel-body">
				<?php $this->showContainerColumn(3); ?>
			</div>
		</div>
	</div>
</div>