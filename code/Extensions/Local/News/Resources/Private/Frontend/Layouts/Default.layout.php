<?php
$this->getPage()->addJsAsset(
	[
		"identifier" => "bootstrap",
		"extension"  => "News",
		"file"       => "bootstrap.js"
	]
);
$this->getPage()->addCssAsset(
	[
		"identifier" => "bootstrap",
		"extension"  => "News",
		"file"       => "bootstrap.css"
	]
); ?>

<div class="container">
	<div class="row">
		<div class="col-xs-12">
			<?php $this->renderPartial('Header/Nav'); ?>
		</div>
	</div>
	<div class="well">
		<?php $this->showContainerId(1); ?>
	</div>

	<div style="row">
		<div class="col-sm-6">
			<?php $this->showContainerId(2); ?>
		</div>
		<div class="col-sm-6 well well-sm">
			<?php $this->showContainerId(3); ?>
		</div>
	</div>
</div>

<?php $this->getPage()->addCssAsset(
	[
		"identifier" => "bootstrap-theme",
		"extension"  => "News",
		"file"       => "bootstrap-theme.css"
	]
); ?>
<?php $this->getPage()->addJsAsset(
	[
		"identifier" => "jquery",
		"extension"  => "News",
		"file"       => "jquery.js",
		"before"     => "bootstrap"
	]
); ?>

<?php $this->getPage()->setTitle("Ludicrous CMS"); ?>