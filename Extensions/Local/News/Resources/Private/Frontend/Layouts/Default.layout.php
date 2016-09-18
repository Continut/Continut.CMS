<?php
$this->getPage()
	->addCssAsset([ "identifier" => "bootstrap", "extension" => "News", "file" => "bootstrap.css" ])
	->addJsAsset([ "identifier" => "bootstrap", "extension" => "News", "file" => "bootstrap.js" ]);
?>

<div class="container">
	<div class="row">
		<div class="col-xs-12">
			<?php $this->renderPartial('Header/Nav'); ?>
		</div>
	</div>
		<div class="panel panel-danger">
			<div class="panel-heading">
				<div class="panel-title">HEADER</div>
			</div>
			<div class="panel-body">
				<?php $this->showContainerColumn(1); ?>
			</div>
		</div>

	<div style="row">
		<div class="col-sm-6">
			<div class="panel panel-info">
				<div class="panel-heading">
					<div class="panel-title">LEFT</div>
				</div>
				<div class="panel-body">
					<?php $this->showContainerColumn(2); ?>
				</div>
			</div>
		</div>
		<div class="col-sm-6">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<div class="panel-title">RIGHT</div>
				</div>
				<div class="panel-body">
					<?php $this->showContainerColumn(3); ?>
				</div>
			</div>
		</div>
	</div>
</div>

<?php $this->getPage()
	->addCssAsset([ "identifier" => "bootstrap-theme", "extension"  => "News", "file" => "bootstrap-theme.css" ])
	->addJsAsset([ "identifier" => "jquery", "extension"  => "News", "file" => "jquery.js", "before" => "bootstrap" ]); ?>