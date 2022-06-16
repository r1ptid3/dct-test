<?php
/**
 * The custom archive functionality of the woocommerce.
 *
 * @since      1.0.0
 *
 * @package    diverse
 * @subpackage diverse/woocommerce/inc
 */

// Enable strict typing mode.
declare( strict_types = 1 );

/**
 * Defines custom woocommerce functionality for archive posts.
 *
 * @package    diverse
 * @subpackage diverse/woocommerce/inc
 */
class R1_WooCommerce_Archive {

	/**
	 * Define the core functionality.
	 *
	 * @since    1.0.0
	 */
	public function __construct() {

		// Initialize woocommerce.
		add_action( 'woocommerce_init', array( $this, 'woo_init' ) );

	}

	/**
	 * Hooks and Filters on woocommerce initialization.
	 *
	 * @since    1.0.0
	 */
	public function woo_init() {

		// Add wrapper to archive sort & results.
		add_action( 'woocommerce_before_shop_loop', array( $this, 'archive_info_open' ), 5 );
		add_action( 'woocommerce_before_shop_loop', array( $this, 'archive_info_close' ), 90 );

		// Customize product tags.
		remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 10 );

		// Wrap product image in <div>.
		add_action( 'woocommerce_before_shop_loop_item', array( $this, 'r1_template_loop_product_image_open' ), 5 );
		add_action( 'woocommerce_shop_loop_item_title', array( $this, 'r1_template_loop_product_image_close' ), 25 );

		// Move add to cart button into product image div.
		remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart' );
		add_action( 'woocommerce_shop_loop_item_title', 'woocommerce_template_loop_add_to_cart', 20 );

		// Transfer of closing </a> tag.
		remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5 );
		add_action( 'woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_link_close', 20 );

		// Transfer Title under </a> tag.
		remove_action( 'woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 10 );
		add_action( 'woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 40 );

		// Add product content wrapper.
		add_action( 'woocommerce_shop_loop_item_title', array( $this, 'product_content_wrapper_open' ), 30 );
		add_action( 'woocommerce_after_shop_loop_item', array( $this, 'product_content_wrapper_close' ), 25 );

		// Add self <a> tag to the title.
		add_action( 'woocommerce_shop_loop_item_title', array( $this, 'product_link_open' ), 35 );
		add_action( 'woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_link_close', 45 );

	}

	/**
	 * Open tag for sort & results bar.
	 *
	 * @since    1.0.0
	 */
	public function archive_info_open() {
		echo '<div class="r1_shop_info">';
	}

	/**
	 * Close tag for sort & results bar.
	 *
	 * @since    1.0.0
	 */
	public function archive_info_close() {
		echo '</div>';
	}

	/**
	 * Open tag for product tags.
	 *
	 * @since    1.0.0
	 */
	public function r1_tags_wrapper_open() {
		echo '<div class="r1_tags_wrapper">';
	}

	/**
	 * Close tag for product tags.
	 *
	 * @since    1.0.0
	 */
	public function r1_tags_wrapper_close() {
		echo '</div>';
	}

	/**
	 * Open tag for product image wrapper.
	 *
	 * @since    1.0.0
	 */
	public function r1_template_loop_product_image_open() {
		echo '<div class="product__image">';
	}

	/**
	 * Close tag for product image wrapper.
	 *
	 * @since    1.0.0
	 */
	public function r1_template_loop_product_image_close() {
		echo '</div>';
	}

	/**
	 * Open tag for product content wrapper.
	 *
	 * @since    1.0.0
	 */
	public function product_content_wrapper_open() {
		echo '<div class="product__content">';
	}

	/**
	 * Open tag for product content wrapper.
	 *
	 * @since    1.0.0
	 */
	public function product_content_wrapper_close() {
		echo '</div>';
	}

	/**
	 * Open ling tag for product title.
	 *
	 * @since    1.0.0
	 */
	public function product_link_open() {
		global $product;

		$link = apply_filters( 'woocommerce_loop_product_link', get_the_permalink(), $product );

		echo '<a href="' . esc_url( $link ) . '" class="product_title">';
	}

}
