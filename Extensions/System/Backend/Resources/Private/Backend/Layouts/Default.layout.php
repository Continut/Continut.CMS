<?php
$this->getPage()
	->addCssAsset( [ "identifier" => "bootstrap", "extension" => "Backend", "file" => "bootstrap/bootstrap.css" ])
	->addCssAsset( [ "identifier" => "bootstrap-select", "extension" => "Backend", "file" => "bootstrap-select/bootstrap-select.css" ])
	->addCssAsset( [ "identifier" => "fontawesome", "extension" => "Backend", "file" => "fontawesome/font-awesome.css" ])
	->addCssAsset( [ "identifier" => "flagicons", "extension" => "Backend", "file" => "flagicons/flag-icon.css" ])
	->addCssAsset( [ "identifier" => "jqtree", "extension" => "Backend", "file" => "jqtree/jqtree.css" ])
	->addCssAsset( [ "identifier" => "local", "extension" => "Backend", "file" => "local/backend.css" ])
	->addCssAsset( [ "identifier" => "google-roboto-font", "external" => TRUE, "file" => "//fonts.googleapis.com/css?family=Roboto+Condensed&subset=latin,latin-ext,cyrillic-ext,greek-ext,greek,vietnamese,cyrillic"]);
$this->getPage()
	->addJsAsset( [ "identifier" => "jquery", "extension"  => "Backend", "file" => "jquery/jquery-1.11.2.js" ])
	->addJsAsset( [ "identifier" => "bootstrap", "extension"  => "Backend", "file" => "bootstrap/bootstrap.js" ])
	->addJsAsset( [ "identifier" => "bootstrap-select", "extension"  => "Backend", "file" => "bootstrap-select/bootstrap-select.js" ])
	->addJsAsset( [ "identifier" => "tree", "extension"  => "Backend", "file" => "jqtree/tree.jquery.js" ])
	->addJsAsset( [ "identifier" => "pep", "extension"  => "Backend", "file" => "pep/jquery.pep.js" ]);
?>
<div id="main_toolbar" class="collapse navbar-collapse">
	<div class="pull-left">
		<h1><i class="fa fa-cc"></i> Conţinut CMS <small>v 0.0.1</small></h1>
	</div>
	<ul class="nav navbar-nav navbar-right">
		<li>
			<a href="#"><i class="fa fa-fw fa-cogs"></i> Settings</a>
		</li>
		<li role="presentation" class="dropdown">
			<a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-expanded="false"><i class="fa fa-fw fa-user"></i> Gringo Deluxe <span class="caret"></span></a>
			<ul class="dropdown-menu" role="menu">
				<li><a href="#">User profile</a></li>
				<li class="divider"></li>
				<li><a href="#">Logout</a></li>
			</ul>
		</li>
	</ul>
</div>
<nav class="navbar navbar-default" id="mainmenu">
	<div class="container-fluid">
		<?= \Core\Utility::callPlugin("Backend", "Index", "mainmenu"); ?>
	</div>
</nav>
<div id="container" class="container-fluid">
	<?= $this->showContent(); ?>
</div>