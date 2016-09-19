<?php
$this->getPageView()
    ->addCssAsset(["identifier" => "f1", "extension" => "ThemeAtlas", "external" => TRUE, "file" => "http://fonts.googleapis.com/css?family=Raleway:400,500,600,700,800,300"])
    ->addCssAsset(["identifier" => "f2", "extension" => "ThemeAtlas", "external" => TRUE, "file" => "http://fonts.googleapis.com/css?family=Oswald:400,500,600,700,800,300"])
    ->addCssAsset(["identifier" => "bootstrap", "extension" => "ThemeAtlas", "file" => "bootstrap.css"])
    ->addCssAsset(["identifier" => "owl", "extension" => "ThemeAtlas", "file" => "owl.carousel.css"])
    ->addCssAsset(["identifier" => "font-awesome", "extension" => "ThemeAtlas", "file" => "font-awesome.css"])
    ->addCssAsset(["identifier" => "prettyPhoto", "extension" => "ThemeAtlas", "file" => "prettyPhoto.css"])
    ->addCssAsset(["identifier" => "animation", "extension" => "ThemeAtlas", "file" => "animation.css"])
    ->addCssAsset(["identifier" => "style", "extension" => "ThemeAtlas", "file" => "style.css"])
    //->addJsAsset([ "identifier" => "gmap", "extension" => "ThemeAtlas", "external" => TRUE, "file" => "http://maps.google.com/maps/api/js?sensor=false" ])
    ->addJsAsset(["identifier" => "jquery", "extension" => "ThemeAtlas", "file" => "jquery.js"])
    ->addJsAsset(["identifier" => "bootstrap", "extension" => "ThemeAtlas", "file" => "bootstrap.min.js"])
    ->addJsAsset(["identifier" => "smooth", "extension" => "ThemeAtlas", "file" => "smooth-scroll.js"])
    ->addJsAsset(["identifier" => "parallax", "extension" => "ThemeAtlas", "file" => "jquery.parallax-1.1.3.js"])
    ->addJsAsset(["identifier" => "easypiechart", "extension" => "ThemeAtlas", "file" => "jquery.easypiechart.min.js"])
    ->addJsAsset(["identifier" => "owl", "extension" => "ThemeAtlas", "file" => "owl.carousel.js"])
    ->addJsAsset(["identifier" => "jigowatt", "extension" => "ThemeAtlas", "file" => "jquery.jigowatt.js"])
    ->addJsAsset(["identifier" => "custom", "extension" => "ThemeAtlas", "file" => "custom.js"])
    ->addJsAsset(["identifier" => "unveilEffects", "extension" => "ThemeAtlas", "file" => "jquery.unveilEffects.js"])
    ->addJsAsset(["identifier" => "isotope", "extension" => "ThemeAtlas", "file" => "jquery.isotope.min.js"])
    ->addJsAsset(["identifier" => "plugins", "extension" => "ThemeAtlas", "file" => "jquery.themepunch.plugins.min.js"])
    ->addJsAsset(["identifier" => "revolution", "extension" => "ThemeAtlas", "file" => "jquery.themepunch.revolution.min.js"])
    ->addJsAsset(["identifier" => "scrollReveal", "extension" => "ThemeAtlas", "file" => "scrollReveal.js"])
    ->addJsAsset(["identifier" => "prettyPhoto", "extension" => "ThemeAtlas", "file" => "jquery.prettyPhoto.js"])
    ->addJsAsset(["identifier" => "YTPlayer", "extension" => "ThemeAtlas", "file" => "jquery.mb.YTPlayer.js"])
    ->addJsAsset(["identifier" => "local", "extension" => "ThemeAtlas", "file" => "local.js"])
?>

    <div class="animationload">
        <div class="loader">Loading...</div>
    </div> <!-- End Preloader -->

    <!--/HEADER SECTION -->
    <header class="header">
        <div class="container">
            <div class="navbar navbar-default" role="navigation">
                <div class="container-fluid">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse"
                                data-target=".navbar-collapse">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <a href="index.html" class="navbar-brand">ATLAS <br> <span class="slogo">CREATIVE <span></a>
                    </div><!-- end navbar-header -->
                    <div class="navbar-collapse collapse">
                        <ul class="nav navbar-nav navbar-right">
                            <li class="active"><a data-scroll href="#home" class="int-collapse-menu">Home</a></li>
                            <li><a data-scroll href="#features" class="int-collapse-menu">Why Us ?</a></li>
                            <li><a data-scroll href="#about" class="int-collapse-menu">About</a></li>
                            <li><a data-scroll href="#services" class="int-collapse-menu">Services</a></li>
                            <li><a data-scroll href="#pricing" class="int-collapse-menu">Pricing</a></li>
                            <li><a data-scroll href="#team" class="int-collapse-menu">Team</a></li>
                            <li><a data-scroll href="#works" class="int-collapse-menu">Portfolio</a></li>
                            <li><a data-scroll href="#contact" class="int-collapse-menu">Contact</a></li>
                            <li><a href="blog.html">Blog</a></li>
                        </ul>
                    </div><!--/.nav-collapse -->
                </div><!--/.container-fluid -->
            </div>
        </div><!-- end container -->
    </header><!-- end header -->

    <div class="brand-promotion">
        <div class="container">
            <div class="media row">
                <div class="col-sm-4">
                    <div class="brand-content wow fadeIn animated"
                         style="visibility: visible; -webkit-animation: fadeIn 700ms 300ms;">
                        <i class="fa fa-lightbulb-o fa-4x pull-left"></i>
                        <div class="media-body">
                            <h2>Ask Us Anything</h2>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit Curabitur euismod enim a metus
                                adipiscing aliquam. </p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="brand-content wow fadeIn animated"
                         style="visibility: visible; -webkit-animation: fadeIn 700ms 400ms;">
                        <i class="fa fa-laptop fa-4x pull-left"></i>
                        <div class="media-body">
                            <h2>Brand &amp; Identity</h2>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit Curabitur euismod enim a
                                metus.</p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="brand-content wow fadeIn animated"
                         style="visibility: visible; -webkit-animation: fadeIn 700ms 500ms;">
                        <i class="fa fa-headphones fa-4x pull-left"></i>
                        <div class="media-body">
                            <h2>Full Support</h2>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit Curabitur euismod enim a metus
                                adipiscing aliquam.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <section id="home" class="videobg clearfix text-center">
        <a id="volume" onclick="$('#bgndVideo').toggleVolume()"><i class="fa fa-volume-down"></i></a>
        <a id="bgndVideo" class="player"
           data-property="{videoURL:'oNUeGxUrSkY',containment:'body',autoPlay:true, mute:false, startAt:33, opacity:1}">youtube</a>
        <div class="videooverlay">
            <div class="container">
                <div id="owl-intro" class="owl-carousel owl-theme">
                    <div class="item">
                        <div class="sliderbigtitle">
                            <hr class="topline">
                            Experience the <br> Clean and unique <br> One page Design
                            <hr class="bottomline">
                        </div>
                        <div class="slidersmalltitle"> EFFECTIVE BUSINESS SOLUTIONS <br> THAT MAKES YOUR BUSINESS FLY
                            HIGH
                        </div>
                    </div>
                    <div class="item">
                        <div class="sliderbigtitle">
                            <hr class="topline">
                            World Experience <br> Clean Design
                            <hr class="bottomline">
                        </div>
                    </div>
                </div>
                <span class="intro-icon"><a data-scroll-reveal="enter from the bottom after 0.3s" href="#features"><i
                            class="fa fa-angle-down"></i></a></span>
            </div><!-- end container -->
        </div><!-- end overlay -->
    </section><!--/ Video Parallex  End -->

<?= $this->showContainerColumn(1); ?>