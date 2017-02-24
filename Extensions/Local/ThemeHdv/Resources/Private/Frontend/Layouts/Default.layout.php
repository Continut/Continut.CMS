<?php
$this->getPageView()
    ->addCssAsset(["identifier" => "normalize",    "extension" => "ThemeHdv", "file" => "lib/normalize.css"])
    ->addCssAsset(["identifier" => "flexboxgrid",  "extension" => "ThemeHdv", "file" => "lib/flexboxgrid.css"])
    ->addCssAsset(["identifier" => "swiper",       "extension" => "ThemeHdv", "file" => "lib/swiper/swiper-3.4.0.css"])
    ->addCssAsset(["identifier" => "selectize",    "extension" => "ThemeHdv", "file" => "lib/selectize/selectize.css"])
    ->addCssAsset(["identifier" => "mobile-tabs",  "extension" => "ThemeHdv", "file" => "lib/tabs/responsive-tabs.css"])
    ->addCssAsset(["identifier" => "main",         "extension" => "ThemeHdv", "file" => "main.css"])
    ->addJsAsset(["identifier" => "jquery",        "extension" => "ThemeHdv", "file" => "lib/jquery/jquery-3.1.1.min.js"])
    ->addJsAsset(["identifier" => "swiper",        "extension" => "ThemeHdv", "file" => "lib/swiper/swiper-3.4.1.jquery.js"])
    ->addJsAsset(["identifier" => "selectize",     "extension" => "ThemeHdv", "file" => "lib/selectize/selectize.js"])
    ->addJsAsset(["identifier" => "headroom",      "extension" => "ThemeHdv", "file" => "lib/headroom/headroom.js"])
    ->addJsAsset(["identifier" => "headroom-jq",   "extension" => "ThemeHdv", "file" => "lib/headroom/jquery.headroom.js"])
    ->addJsAsset(["identifier" => "mobile-tabs",   "extension" => "ThemeHdv", "file" => "lib/tabs/jquery.responsiveTabs.js"])
    ->addJsAsset(["identifier" => "gsap-plugins",  "extension" => "ThemeHdv", "file" => "lib/greensock/plugins/CSSPlugin.js"])
    ->addJsAsset(["identifier" => "gsap-tween",    "extension" => "ThemeHdv", "file" => "lib/greensock/TweenLite.js"])
    ->addJsAsset(["identifier" => "gsap-timeline", "extension" => "ThemeHdv", "file" => "lib/greensock/TimelineLite.js"])
    ->addJsAsset(["identifier" => "main",          "extension" => "ThemeHdv", "file" => "main.js"]);
?>

    <?= $this->plugin('ThemeHdv', 'Menu', 'mainmenu'); ?>
    <section id="content">
        <div class="container">
            <?= $this->showContainerColumn(1); ?>
        </div>
    </section>
    <?= $this->plugin('ThemeHdv', 'Menu', 'footer'); ?>
