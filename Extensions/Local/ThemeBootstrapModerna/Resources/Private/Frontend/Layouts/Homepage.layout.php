<?php
$this->getPageView()
	->addCssAsset([ "identifier" => "bootstrap",  "extension" => "ThemeBootstrapModerna", "file" => "bootstrap.min.css" ])
	->addCssAsset([ "identifier" => "fancybox",   "extension" => "ThemeBootstrapModerna", "file" => "fancybox/jquery.fancybox.css" ])
	->addCssAsset([ "identifier" => "flexslider", "extension" => "ThemeBootstrapModerna", "file" => "flexslider.css" ])
	->addCssAsset([ "identifier" => "style",      "extension" => "ThemeBootstrapModerna", "file" => "style.css" ])
	->addCssAsset([ "identifier" => "skin",       "extension" => "ThemeBootstrapModerna", "file" => "default.css" ])
	->addJsAsset([  "identifier" => "jquery",     "extension" => "ThemeBootstrapModerna", "file" => "jquery.js" ])
	->addJsAsset([  "identifier" => "easing",     "extension" => "ThemeBootstrapModerna", "file" => "jquery.easing.1.3.js" ])
	->addJsAsset([  "identifier" => "bootstrap",  "extension" => "ThemeBootstrapModerna", "file" => "bootstrap.min.js" ])
	->addJsAsset([  "identifier" => "fancybox",   "extension" => "ThemeBootstrapModerna", "file" => "jquery.fancybox.pack.js" ])
	->addJsAsset([  "identifier" => "fancybox2",  "extension" => "ThemeBootstrapModerna", "file" => "jquery.fancybox-media.js" ])
	->addJsAsset([  "identifier" => "googlecode", "extension" => "ThemeBootstrapModerna", "file" => "google-code-prettify/prettify.js" ])
	->addJsAsset([  "identifier" => "portfolio",  "extension" => "ThemeBootstrapModerna", "file" => "portfolio/jquery.quicksand.js" ])
	->addJsAsset([  "identifier" => "flexslider", "extension" => "ThemeBootstrapModerna", "file" => "jquery.flexslider.js" ])
	->addJsAsset([  "identifier" => "animate",    "extension" => "ThemeBootstrapModerna", "file" => "animate.js" ])
	->addJsAsset([  "identifier" => "custom",     "extension" => "ThemeBootstrapModerna", "file" => "custom.js" ]);
?>

<div id="wrapper">
	<?= $this->plugin("ThemeBootstrapModerna", "Menu", "showMenu"); ?>
</div>
<section class="callaction">
	<div class="container">
		<?= $this->showContainerColumn(2); ?>
	</div>
</section>
<section id="content">
	<div class="container">
		<?= $this->showContainerColumn(1); ?>
	</div>
</section>
<?= $this->plugin("ThemeBootstrapModerna", "Menu", "showFooter"); ?>