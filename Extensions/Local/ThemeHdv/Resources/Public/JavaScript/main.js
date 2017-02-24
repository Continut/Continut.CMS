// get location, if supported
function getLocation() {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(showPosition);
    } else {
        //console.log("Geolocation is not supported by this browser.");
    }
}

function distanceToHospital(lon1, lat1, lon2, lat2) {
    var R = 6371; // Radius of the earth in km
    var dLat = (lat2-lat1).toRad();  // Javascript functions in radians
    var dLon = (lon2-lon1).toRad();
    var a = Math.sin(dLat/2) * Math.sin(dLat/2) +
        Math.cos(lat1.toRad()) * Math.cos(lat2.toRad()) *
        Math.sin(dLon/2) * Math.sin(dLon/2);
    var c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1-a));
    var d = R * c; // Distance in km
    return Math.floor(d);
}

/** Converts numeric degrees to radians */
if (typeof(Number.prototype.toRad) === "undefined") {
    Number.prototype.toRad = function() {
        return this * Math.PI / 180;
    }
}

var hospitals = {
    'brigue': {
        lon: 7.982984,
        lat: 46.317656
    },
    'gravelone': {
        lon: 7.346282,
        lat: 46.232672
    },
    'ich': {
        lon: 7.521547,
        lat: 46.292413
    },
    'martigny': {
        lon: 7.068425,
        lat: 46.099691
    },
    'montana': {
        lon: 7.481371,
        lat: 46.299799
    },
    'monthey': {
        lon: 6.940658,
        lat: 46.254661
    },
    'saint-ame': {
        lon:  6.999111,
        lat: 46.220702
    },
    'sierre': {
        lon: 7.521787,
        lat: 46.291918
    },
    'sion': {
        lon: 7.387193,
        lat: 46.234869
    },
    'viege': {
        lon: 7.884158,
        lat: 46.287948
    }
};

function showPosition(position) {
    $('.swiper-locations .location').each(function(item) {
        var hospitalId = $(this).data('location');
        if (hospitalId) {
            var distance = distanceToHospital(position.coords.longitude, position.coords.latitude, hospitals[hospitalId].lon, hospitals[hospitalId].lat);
            $(this).find('.distance').first().text(distance + ' km').show();
        }
    });
    //console.log(distance(position.coords.longitude, position.coords.latitude, 7.387193, 46.234869) + ' km');
    //console.log("Latitude: " + position.coords.latitude + "Longitude: " + position.coords.longitude);
}

function resizeText(multiplier) {
    $('html').css('font-size', parseFloat($('html').css('font-size')) + (multiplier * 1) + "px");
}

$(document).ready(function () {

    // increase/decrease font
    $('.increase-font').on('click', function (event) {
        event.preventDefault();
        resizeText(1);
    });
    $('.decrease-font').on('click', function (event) {
        event.preventDefault();
        resizeText(-1);
    });

    // main swiper
    $('.swiper-main').swiper({
        direction: 'horizontal',
        loop: false,
        scrollbar: '.swiper-scrollbar',
        scrollbarHide: true,
        grabCursor: true,
        nextButton: '.hdv-swiper-button-next',
        prevButton: '.hdv-swiper-button-prev',
    });

    // swipers
    var swipers = [];

    $('.swiper-container').each(function (index) {
        var $el = $(this);

        if ($el.hasClass('swiper-gallery')) {
            swipers[index] = $el.swiper({
                direction: 'horizontal',
                loop: false,
                //scrollbar: '.swiper-scrollbar',
                //scrollbarHide: true,
                grabCursor: true
            });
        }
        if ($el.hasClass('swiper-jobs')) {
            swipers[index] = $el.swiper({
                direction: 'horizontal',
                loop: false,
                spaceBetween: 10,
                grabCursor: true
            });
        }
        if ($el.hasClass('swiper-locations')) {
            swipers[index] = $el.swiper({
                direction: 'horizontal',
                loop: false,
                slidesPerView: 4,
                grabCursor: true,
                scrollbar: '.swiper-scrollbar',
                scrollbarHide: true,
                breakpoints: {
                    1024: {
                        slidesPerView: 3
                    },
                    640: {
                        slidesPerView: 2
                    },
                    480: {
                        slidesPerView: 1
                    }
                }
            });
        }
        if ($el.hasClass('swiper-organisation')) {
            swipers[index] = $el.swiper({
                direction: 'horizontal',
                loop: false,
                slidesPerView: 3,
                grabCursor: true,
                scrollbar: '.swiper-scrollbar',
                scrollbarHide: true,
                breakpoints: {
                    640: {
                        slidesPerView: 2
                    },
                    480: {
                        slidesPerView: 1
                    }
                }
            });
        }

        $el.next('.outer-pagination').find('.hdv-swiper-button-next').on('click', function (event){
            event.preventDefault();

            swipers[index].slideNext();
        });

        $el.next('.outer-pagination').find('.hdv-swiper-button-prev').on('click', function (event){
            event.preventDefault();

            swipers[index].slidePrev();
        });

    });

    // swiper header animations
    $('.swiper-slide, .swiper-static')
    // tile mouse actions
        .on('mouseover', function(){
            $(this).children('.bg-image').css({'transform': 'scale(1.05)'});
        })
        .on('mouseout', function(){
            $(this).children('.bg-image').css({'transform': 'scale(1)'});
        })
        .on('mousemove', function(e){
            $(this).children('.bg-image').css({'transform-origin': ((e.pageX - $(this).offset().left) / $(this).width()) * 100 + '% ' + ((e.pageY - $(this).offset().top) / $(this).height()) * 100 +'%'});
        });
    // and their mobile correspondents
    if (window.DeviceOrientationEvent) {
        var swipeImages = $('.swiper-slide, .swiper-static').children('.bg-image');
        swipeImages.css({'transform': 'scale(1.1)'});
        //debugger;
        window.addEventListener("deviceorientation", function(event)
        {
            //var xValue = Math.round(event.alpha);
            var yawValue = 15 + Math.round(event.beta);
            var Rotation = 45 + Math.round(event.gamma);

            swipeImages.css({'transform-origin': Rotation + '% ' + yawValue +'%'});
        }, true);
    } else {
        //console.log("Sorry, your browser doesn't support Device Orientation");
    }

    // initialize the tabs plugin
    $('.hdv-tabs').responsiveTabs({
        startCollapsed: false,
        collapsible: true,
        //animation: 'slide',
        active: 0
    });

    $('.has-dropdown > a').on('click', function(event) {
        event.preventDefault();

        $(this).parent().toggleClass('open');
    });

    // Mainmenu handling
    var menuIsMobile = $('.toggleMobile').is(':visible');

    // are we in mobile mode, or desktop?
    if (menuIsMobile) {
        $('.toggleMobile').on('click', function (event) {
            event.preventDefault();

            $(this).toggleClass('open');
            $('.mobile-menu').toggle();
            $('.search-text').hide();
            $('.main-menu').show();
            $('.show-search').toggle();
            //$('.mobile-menu-shortcut, .logo').toggle();
            $('.logo').toggle();
            $('#menu').toggleClass('mobile-display');
            // ?
            $('.menu-wrapper, .overlay-mainmenu').toggle();
            $('.menu-title').toggle();
            if ($(this).hasClass('open')) {
                $('#menu_title').text('Menu');
                $('.top-menu').show();
                $('.level-1 ul').hide();
                $('.level-1 > li').show();
                $('.level-1 > li > a').show();
                TweenLite.fromTo($('.level-1'), 0.75, {x: 100, autoAlpha: 0}, {x: 0, autoAlpha: 1, ease: Power3.easeOut});
                TweenLite.fromTo($('.menu-title'), 0.5, {y: -20, autoAlpha: 0}, {y: 0, autoAlpha: 1, ease: Power3.easeOut});
                TweenLite.fromTo($('.top-menu'), 0.75, {y: 20, autoAlpha: 0}, {y: 0, autoAlpha: 1, ease: Power3.easeOut});
            } else {
                //$('.menu-title').();
            }
        });

        $('.menu-title .less').on('click', function (event) {
            event.preventDefault();

            var target = $(this).data('target');
            if (target) {
                var $targetUl = $('#' + target);
                var previousId = $targetUl.parent().parent().attr('id');
                $targetUl.hide();
                $targetUl.siblings().show();
                $targetUl.parent().siblings().show();
                /*TweenLite.fromTo($targetUl, 0.75, {x: 0, autoAlpha: 0}, {x: 100, autoAlpha: 1, ease: Power3.easeOut, onComplete: function() {
                    $targetUl.hide();
                }});*/
                TweenLite.fromTo($targetUl.parent().siblings(), 0.75, {x: -100, autoAlpha: 0}, {x: 0, autoAlpha: 1, ease: Power3.easeOut});
                TweenLite.fromTo($targetUl.siblings().show(), 0.75, {x: -100, autoAlpha: 0}, {x: 0, autoAlpha: 1, ease: Power3.easeOut});
                //$targetUl.removeClass('slide-in').addClass('slide-out');
                //$targetUl.siblings().fadeIn();
                //$targetUl.parent().siblings().fadeIn();
                $('.menu-title .less').data('target', previousId);
                if (previousId) {
                    $('#menu_title').text($('.main-menu').find("[data-target='" + previousId + "']").text());
                } else {
                    $('#default_menu_title').show();
                    $(this).hide();
                    $('.top-menu').show();
                    TweenLite.fromTo($('.top-menu'), 0.75, {y: 20, autoAlpha: 0}, {y: 0, autoAlpha: 1, ease: Power3.easeOut});
                }
                TweenLite.fromTo($('.menu-title'), 0.5, {y: -20, autoAlpha: 0}, {y: 0, autoAlpha: 1, ease: Power3.easeOut});
            }
        });

        // Mobile main menu, once you click on the ">" arrow
        $('.main-menu .more, .levels .more').on('click', function (event) {
            event.preventDefault();

            $('.top-menu').hide();
            $(this).parent().siblings().hide();
            // get the ul with the subpages
            var target = $(this).prev().data('target');
            var $targetUl = $('#' + target);
            //targetUl.removeClass('slide-out').addClass('slide-in');
            // attach it as a subchild, if it is not the case
            if ($targetUl.parent() != $(this).parent()) {
                $(this).parent().append($targetUl);
            }
            $targetUl.find('li').show();
            //$targetUl.find('a').show();
            $targetUl.show();
            //debugger;
            /*TweenLite.fromTo($(this).parent().siblings(), 0.75, {x: 0, autoAlpha: 1}, {x: -100, autoAlpha: 0, ease: Power3.easeOut, onComplete: function() {
                $(this).parent().siblings().hide();
            }});*/
            TweenLite.fromTo($targetUl, 0.75, {x: 100, autoAlpha: 0}, {x: 0, autoAlpha: 1, ease: Power3.easeOut});
            //$(this).next().addClass('slide-in');
            $(this).parent().find('> a').hide();

            $('#default_menu_title').hide();
            $('#menu_title').text($(this).prev().text());
            $('.menu-title .less').show().data('target', target);

            TweenLite.fromTo($('.menu-title'), 0.5, {y: -20, autoAlpha: 0}, {y: 0, autoAlpha: 1, ease: Power3.easeOut});
        });
    } else {
        // Desktop main menu behaviour
        $('.level-1 .menu-item a').on('click', function (event) {
            // grab the target id
            var target = $(this).data('target');
            var $menuContainer = $('.menu-wrapper .menu-row');
            // un-move the menu
            if ($menuContainer.hasClass('moved')) {
                TweenLite.to($menuContainer, 0.75, {xPercent: 0, ease: Power3.easeOut});
            }
            $menuContainer.removeClass('moved back');
            // unselect all links on current level
            $('.level-1 li').removeClass('open');
            // and open the current one
            $(this).parent().toggleClass('open');
            // update the main level title
            //-$('#menu_title_1').html($(this).clone());
            //-TweenLite.fromTo($('#menu_title_1'), 1, {x: -100, autoAlpha: 0}, {x: 0, autoAlpha: 1, ease: Power3.easeOut});
            // and empty the secondary ones
            //-$('.secondary-title').empty();
            // hide all submenus
            $('.levels').hide();
            // unset the bordered class
            $('.menu-wrapper .bordered').removeClass('bordered');
            // and show only the selected one
            $('#' + target).show();
            TweenLite.fromTo($('#' + target), 0.75, {x: -100, autoAlpha: 0}, {x: 0, autoAlpha: 1, ease: Power3.easeOut});
            $('#' + target + ' .open').removeClass('open');
            // hide all summaries
            $('.summaries div').hide();
            // and show only the selected one, if any
            $('#summary-' + target).show();
            $('#summary-' + target + ' ul').show();
            TweenLite.fromTo($('.menu-col.summary'), 0.75, {x: 100, autoAlpha: 0}, {x: 0, autoAlpha: 1, ease: Power3.easeOut});
            if (!$('.menu-wrapper').is(':visible')) {
                $('.menu-wrapper, .overlay-mainmenu').toggle();
                TweenLite.fromTo($('.overlay-mainmenu'), 0.5, {y: -100}, {y: 0, autoAlpha: 1, ease: Power3.easeOut});
            }

            event.preventDefault();
        });

        $('.overlay-mainmenu .close').on('click', function(event) {
            event.preventDefault();

            $('.menu-wrapper').hide()
            TweenLite.to($('.overlay-mainmenu'), 0.5, {y: -50, autoAlpha: 0, ease: Power3.easeOut, onComplete: function() {
                $('.overlay-mainmenu').hide();
            }});
            $('.level-1 li').removeClass('open');
        });

        $('.levels a').on('click', function(event) {
            var level = parseInt($(this).parent().parent().data('level'));
            var $targetUl = $('#' + $(this).data('target'));
            // if it has subpages, show them
            if ($targetUl.length) {
                var $menuContainer = $('.menu-wrapper .menu-row');
                $targetUl.parent().addClass('bordered');
                // copy the link in the title of the current level
                //$('#menu_title_' + level).html($(this).clone()).show();
                //TweenLite.fromTo($('#menu_title_' + level), 0.75, {x: -100, autoAlpha: 0}, {x: 0, autoAlpha: 1, ease: Power3.easeOut});
                // hide the summary if we are on the 4th level
                if (level == 4) {
                    $('.summaries ul, .summaries p').hide();
                }
                // if we need to show the 6th level, slide it in
                if (level == 5) {
                    TweenLite.to($menuContainer, 0.75, {xPercent: -20, ease: Power3.easeOut});
                    $menuContainer.addClass('moved').removeClass('back');
                }
                if ((level == 3) && $menuContainer.hasClass('moved')) {
                    TweenLite.to($menuContainer, 0.75, {xPercent: 0, ease: Power3.easeOut});
                    $menuContainer.removeClass('moved').addClass('back');
                }
                // unset all previous subpages, if any
                if (level <= 6) {
                    for (var i = level + 1; i <= 6; i++) {
                        $('.level-' + i).hide();
                        $('.level-' + i + ' a').removeClass('open');
                        $('#menu_title_' + i).empty();
                    }
                }
                var tl = new TimelineLite( { onComplete: function() {
                    this.restart()
                }});
                tl.fromTo($('.return-button'), 1, {x: 5}, {x: -5, ease: Power3.easeOut});
                // clear all the previous selections for this level
                $('.level-' + (level + 1)).hide();
                //TweenLite.fromTo($('.level-' + (level + 1)), 1, {x: 0}, {x: -100, autoAlpha: 0, ease: Elastic.easeIn});
                // select the item
                $('.level-' + level + ' li a').removeClass('open');
                $(this).addClass('open');
                TweenLite.fromTo($targetUl, 0.75, {x: -100, autoAlpha: 0}, {x: 0, autoAlpha: 1, ease: Power3.easeOut});
                $targetUl.show();
                event.preventDefault();
            }
            // if not it's a leaf page, so handle the "href" link
        });

        $('.return-button').on('click', function (event) {
            event.preventDefault();

            var $menuContainer = $('.menu-wrapper .menu-row');
            TweenLite.to($menuContainer, 0.75, {xPercent: 0, ease: Power3.easeOut});
            $menuContainer.removeClass('moved').addClass('back');
        });
    }

    // Sidebar links
    $('#sidebar .links a').on('click', function (event) {
        // close all other detail divs
        $('#sidebar .details').removeClass('open');
        if ($(this).hasClass('open')) {
            $(this).removeClass('open');
            $('#sidebar').removeClass('open');
        } else {
            $('#sidebar').addClass('open');
            // unset all open links
            $('#sidebar .links a').removeClass('open');
            // and show the currently selected one
            var targetDiv = $(this).toggleClass('open').data('target');
            $('#' + targetDiv).addClass('open');
        }

        event.preventDefault();
    });

    /*$('.general-select').select2({
        theme: 'hdv',
        minimumResultsForSearch: -1,
        //width: ''
    });*/

    // disable textinput on selectize, so we do not have keyboard displayed on mobile
    var prevSetup = Selectize.prototype.setup;

    Selectize.prototype.setup = function () {
        prevSetup.call(this);

        this.$control_input.prop('readonly', true);
    };

    $('.general-select').selectize({
        sortField: 'text',
        allowEmptyOption: true
    });

    // search toggle
    $('.show-search').on('click', function(event) {
        //$('.logo a').toggle();
        $($(this).data('for')).toggle().toggleClass('slide-in');
        $('.main-menu').toggle().removeClass('slide-in');
        event.preventDefault();
    });

    $('.search-text .close').on('click', function(event) {
        event.preventDefault();

        $('.main-menu').toggle().toggleClass('slide-in');
        $(this).closest('.search-text').removeClass('slide-in').toggle();
    });

    // scroll to top on click
    $(".jump-to-top a").click(function(event) {
        event.preventDefault();
        $("html, body").animate({ scrollTop: 0 }, "slow");
        return false;
    });

    // show scroll to top only after 400 pixels
    $(document).scroll(function() {
        var y = $(this).scrollTop();
        if (y > 400) {
            $('.jump-to-top').addClass('animate')
        } else {
            $('.jump-to-top').removeClass('animate');
        }
    });

    //$('#menu').sticky({center: false, responsiveWidth: false, widthFromWrapper: false, zIndex: 1000});
    $('#menu').headroom({offset: 50});

    // Lightbox
    var galleries = {};

    $('.swiper-gallery .zoom').each(function() {
        var $pic = $(this);
        var $size   = $pic.data('size').split('x'),
            $width  = $size[0],
            $height = $size[1],
            $galleryId = $pic.data('gallery');

        // create a new gallery if one does not exist
        if (!galleries[$galleryId]) {
            galleries[$galleryId] = {};
            galleries[$galleryId].items = [];
        }

        // add new item to current category
        var item = {
            src:   $pic.attr('href'),
            title: $pic.data('caption'),
            w:     $width,
            h:     $height
        };

        galleries[$galleryId].items.push(item);

        //items.push(item);
    });

    var $pswp = $('.pswp')[0];

    $('.swiper-gallery .zoom').on('click', function(event) {
        event.preventDefault();

        var $galleryId = $(this).data('gallery');
        var $index = $(this).data('index');

        var options = {
            index: $index,
            bgOpacity: 0.9,
            showHideOpacity: true
        };

        var lightBox = new PhotoSwipe($pswp, PhotoSwipeUI_Default, galleries[$galleryId].items, options);
        lightBox.init();
    });

    if ($('.map-chooser').length) {
        var $mapSelector = $('select[name="site_selector"]').selectize({
            //allowEmptyOption: true
            onChange: function (value) {
                var $card = $('#hospital_details_card');

                TweenLite.to($card, 0.5, {
                    autoAlpha: 0, y: -40, ease: Power3.easeOut, onComplete: function () {
                        $.ajax({
                            url: "index.php?id=3&type=9064&tx_hdv_general[controller]=Site&tx_hdv_general[action]=siteInfo",
                            data: {'tx_hdv_general[site]': value},
                            dataType: "html"
                        })
                            .done(function (data) {
                                $card.html(data);
                                TweenLite.to($card, 0.5, {autoAlpha: 1, y: 0, ease: Power3.easeOut});

                                $('.map-chooser a').removeClass('selected');
                                $('a[data-hospital=' + value + ']').addClass('selected');
                            });
                    }
                });
            }
        });
        var mapSelectize = $mapSelector[0].selectize;

        // map points on homepage/map cards
        $('.map-chooser a').on('click', function (event) {
            event.preventDefault();

            mapSelectize.setValue($(this).data('hospital'));
        });
    }

    //getLocation(); // get hospitals GPS locations
});