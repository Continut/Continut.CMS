<div class="container-fluid header">
    <!-- Slider main container -->
    <div class="swiper-container swiper-general swiper-header swiper-main">
        <!-- Additional required wrapper -->
        <div class="swiper-wrapper">
            <!-- Slides -->
            <div class="swiper-slide">
                <div class="bg-image" style="background-image:url('<?= $this->helper('Image')->resize($image, 1680, 595) ?>');"></div>
                <div class="bg-image mobile" style="background-image:url('<?= $this->helper('Image')->crop($image, 640, 470) ?>');"></div>
                <div class="container container-absolute inside">
                    <div class="row">
                        <div class="col-xs-10 col-sm-6 col-md-5 col-lg-4">
                            <h2>Bienvenue à l'Hôpital du Valais</h2>
                            <h1>L'être humain au centre</h1>
                            <p>Un seul hôpital sur plusieurs sites, au centre des réseaux de soins, coopérant étroitement avec les médecins indépendants, les EMS et les CMS pour que les patients soient pris en charge au bon moment, au bon endroit, pour la bonne prestation.</p>
                            <p class="more text-right"><a href="bla.html">Lire la suite</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- If we need pagination -->
        <div class="swiper-pagination"></div>

        <!-- If we need navigation buttons -->
        <div class="container container-absolute footer-pagination">
            <div class="row end-xs">
                <div class="col-xs-6 col-sm-2 buttons">
                    <a href="#" class="hdv-swiper-button-prev"><span class="icon-arrow2-left"></span></a><a href="#" class="hdv-swiper-button-next"><span class="icon-arrow2-right"></span></a>
                </div>
            </div>
        </div>

        <!-- If we need scrollbar -->
        <div class="swiper-scrollbar"></div>

    </div>
</div>