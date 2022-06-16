"use strict";

var $ = jQuery.noConflict();
var mainMenu = $('.r1-header__menu');
var mainMenuOffset = mainMenu[0].offsetTop;

window.addEventListener( "load", function () {
    r1_banner();
    r1_preloader();
    r1_menu_equal_width();
    r1_product_sliders();
    r1_trigger_search();
    r1_mobile_menu();
});

$(window).scroll( function () {
    r1_fix_menu_to_top();
});

$(window).resize( function () {
    mainMenuOffset = mainMenu[0].offsetTop;
    r1_menu_equal_width();
    r1_mobile_menu();
});

$(window).on( 'orientationchange', function () {
    r1_menu_equal_width();
});

/**
 * Hide preloader after small delay for smooth page loading.
 *
 * @since    1.0.0
 */
function r1_preloader() {
    setTimeout(function(){
        $('.r1-preloader').addClass('hidden');
    }, 400);
}

/**
 * Centering menu in flexible container.
 *
 * @since    1.0.0
 */
function r1_menu_equal_width() {
    let minWidht = 0;

    if ( $(window).width() > 1023 ) {
        $('.r1-header__container > *:not(.r1-header__nav)').each(function(i, el) {
            minWidht = $(el).width() > minWidht ? $(el).width() : minWidht;
        });

        $('.r1-header__container > *:not(.r1-header__nav)').css('min-width', minWidht + 'px');
    } else {
        $('.r1-header__container > *:not(.r1-header__nav)').css('min-width', '0');
    }
}

/**
 * Init homepage slider.
 *
 * @since    1.0.0
 */
function r1_banner() {
    let slider = $('.r1-banner');

    if ( slider.length > 0 ) {
        slider.slick({
            arrows: false,
            dots: false,
            autoplay: true,
            autoplaySpeed: 3500,
            infinite: true,
        });
    }
}

/**
 * Init homepage product sliders on homepage.
 *
 * @since    1.0.0
 */
function r1_product_sliders() {
    let products = $('.home div.woocommerce:not(.specials) > ul.products');

    if ( products.length > 0 ) {

        products.each(function(i, el) {

            let columns = $(el).hasClass('columns-4') ? 4 : 3;
            // let tabletColumns = 4 === columns ? 4 : 2;

            $(el).slick({
                slidesToShow: columns,
                slidesToScroll: columns,
                dots: true,
                arrows: false,
                responsive: [
                    {
                        breakpoint: 767,
                        settings: {
                            slidesToShow: 2,
                            slidesToScroll: 2,
                        }
                    }
                ]
            });

        });

    }
}

/**
 * Toggle searchform visibility on click.
 *
 * @since    1.0.0
 */
function r1_trigger_search() {
    let searchTrigger = $('.search-link');
    let searchForm = $('.woocommerce-product-search');

    if ( searchTrigger.length > 0 && searchForm.length > 0 ) {
        searchTrigger.on('click', function() {
            searchForm.slideToggle(300);
        });
    }
}

/**
 * Toggle searchform visibility on click.
 *
 * @since    1.0.0
 */
function r1_fix_menu_to_top() {
    let menu = $('.r1-header__menu');
    let menuHeight = menu[0].clientHeight;

    if ( menu.length > 0 && $(window).width() >= 1024 ) {

        if ( $(window).scrollTop() >= mainMenuOffset ) {
            menu.addClass('fixed');
            $('.r1-header').css('padding-bottom', menuHeight + 'px');
        } else {
            menu.removeClass('fixed');
            $('.r1-header').css('padding-bottom', '0');
        }

    }
}

/**
 * Toggle mobile menu.
 *
 * @since    1.0.0
 */
function r1_mobile_menu() {
    let menuTrigger = $('.mobile-menu-trigger');
    menuTrigger.off();

    if ( menuTrigger.length > 0 && $(window).width() < 1024 ) {
        menuTrigger.on('click', function() {

            let this_is = $(this);
            let menu = $('.r1-header__menu__nav');

            this_is.toggleClass('active');
            menu.toggleClass('active');
            $('body').toggleClass('r1-disable-scroll');

        });
    }
}