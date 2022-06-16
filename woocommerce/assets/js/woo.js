var $ = jQuery.noConflict();

window.addEventListener( "load", function () {
    r1_open_mini_cart();
});

$(window).resize( function () {

});

$(window).on( 'orientationchange', function () {

});

$( document.body ).on( 'updated_cart_totals applied_coupon removed_coupon', function() {

});

$( document.body ).on( 'added_to_cart removed_from_cart', function() {

});

$( document.body ).on( 'checkout_error', function() {

});

$( document.body ).on( 'update_checkout', function() {

});

$( document.body ).on( 'country_to_state_changed', function() {

});

/**
 * Toggle mini-cart clicked on trigger.
 *
 * @since    1.0.0
 */
function r1_open_mini_cart() {
    if ( $(window).width() > 767 ) {

        $('.mini_cart_trigger').on('click', function(e) {
            $(this).next().toggleClass('active');
            e.preventDefault();
        });

        $('body').click( function(e) {    
            let target = $(e.target);

            if ( target.hasClass('mini-cart') || target.closest('.mini-cart').length ) {
                return;
            }

            $('.woo_mini_cart').removeClass('active');
        });

    }
}
