<?php
$this->getPageView()
	->addJsAsset([ "identifier" => "bootstrap", "extension" => "ThemeBootstrap", "file" => "bootstrap.js" ])
	->addCssAsset([ "identifier" => "bootstrap", "extension" => "ThemeBootstrap", "file" => "bootstrap.css" ]);
?>

	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<?= $this->plugin("ThemeBootstrap", "Menu", "showMenu"); ?>
				<h1><?= $this->getPage()->getTitle(); ?></h1>
			</div>
			<div class="col-sm-8">
				<div class="panel panel-default">
					<div class="panel-heading">
						<div class="panel-title">Left column</div>
					</div>
					<div class="panel-body">
						<?= $this->showContainerColumn(1); ?>
					</div>
				</div>
			</div>
			<div class="col-sm-4">
				<div class="panel panel-primary">
					<div class="panel-heading">
						<div class="panel-title">Right column</div>
					</div>
					<div class="panel-body">
						<?= $this->showContainerColumn(2); ?>
					</div>
				</div>
			</div>
		</div>
	</div>

<?php
$this->getPage()
	->addCssAsset([ "identifier" => "bootstrap-theme", "extension" => "ThemeBootstrap", "file" => "bootstrap-theme.css" ])
	->addJsAsset([ "identifier" => "jquery", "extension" => "ThemeBootstrap", "file" => "jquery-1.11.2.js", "before" => "bootstrap" ]);
?>