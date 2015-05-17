<div class="row" id="content_saver">
	<div class="col-sm-8">
		<div class="btn-group">
			<button type="button" class="btn btn-primary"><i class="fa fa-fw fa-save"></i> <?= $this->__("backend.content.save") ?></button>
			<button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
				<span class="caret"></span>
				<span class="sr-only">Toggle Dropdown</span>
			</button>
			<ul class="dropdown-menu" role="menu">
				<li><a href="#"><i class="fa fa-fw fa-save"></i> <?= $this->__("backend.content.saveAndClose") ?></a></li>
				<li><a href="#"><i class="fa fa-fw fa-close"></i> <?= $this->__("backend.content.close") ?></a></li>
				<li class="divider"></li>
				<li><a href="#"><i class="fa fa-fw fa-history"></i> <?= $this->__("backend.content.history") ?></a></li>
			</ul>
		</div>
	</div>
	<div class="col-sm-4">
		<div role="group" class="btn-group pull-right">
			<button id="page-delete" class="btn btn-danger" type="button"><i class="fa fa-fw fa-trash"></i> <?= $this->__("backend.content.delete") ?></button>
		</div>
	</div>
</div>