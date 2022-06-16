<?php
/**
 * The common functionality of the woocommerce.
 *
 * @since      1.0.0
 *
 * @package    diverse
 * @subpackage diverse/woocommerce/inc
 */

// Enable strict typing mode.
declare( strict_types = 1 );

/**
 * Defines custom woocommerce functionality for whole website.
 *
 * @package    diverse
 * @subpackage diverse/woocommerce/inc
 */
class R1_WooCommerce_Common {

	/**
	 * Define the core functionality.
	 *
	 * @since    1.0.0
	 */
	public function __construct() {

		add_theme_support( 'woocommerce' );

		// Disable woocommerce styles.
		add_filter( 'woocommerce_enqueue_styles', '__return_empty_array' );

		// Remove add to cart message.
		add_filter( 'wc_add_to_cart_message_html', '__return_false' );

		// Enable default WooCommerce functionality.
		add_action( 'after_setup_theme', array( $this, 'theme_supports' ) );

		// Enqueue scripts and styles.
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_style' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ) );

		// Ajax add to cart.
		add_action( 'wp_ajax_r1_ajax_add_to_cart', array( $this, 'ajax_add_to_cart' ) );
		add_action( 'wp_ajax_nopriv_r1_ajax_add_to_cart', array( $this, 'ajax_add_to_cart' ) );

		// Change WooCommerce minicart content.
		add_filter( 'woocommerce_add_to_cart_fragments', array( $this, 'header_add_to_cart_fragment' ), 30, 1 );

		// Add wrapper to minicart.
		add_action( 'woocommerce_before_mini_cart', array( $this, 'minicart_wrapper_open' ) );
		add_action( 'woocommerce_after_mini_cart', array( $this, 'minicart_wrapper_close' ) );

	}

	/**
	 * Enable default WooCommerce functionality.
	 *
	 * @since    1.0.0
	 */
	public function theme_supports() {
		add_theme_support( 'wc-product-gallery-zoom' );
		add_theme_support( 'wc-product-gallery-lightbox' );
		add_theme_support( 'wc-product-gallery-slider' );
	}

	/**
	 * Enqueue styles.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_style() {
		wp_enqueue_style(
			'woo-styles',
			get_template_directory_uri() . '/woocommerce/assets/css/woocommerce.css',
			array(),
			R1__VERSION,
			'all'
		);
	}

	/**
	 * Enqueue and localize scripts.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {
		global $wp_query;

		wp_enqueue_script( 'woo-scripts', get_template_directory_uri() . '/woocommerce/assets/js/woo.js', array(), R1__VERSION, 'all' );

		wp_localize_script(
			'woo-scripts',
			'woo_script_load_more_params',
			array(
				'posts'        => wp_json_encode( $wp_query->query_vars ),
				'current_page' => get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1,
				'max_page'     => $wp_query->max_num_pages,
			)
		);
	}

	/**
	 * Ajax add to cart.
	 *
	 * @since    1.0.0
	 */
	public function ajax_add_to_cart() {
		WC_AJAX::get_refreshed_fragments();
		wp_die();
	}

	/**
	 * Redirect to homepage after logout.
	 *
	 * @param    object $fragments - WooCommerce mini cart object.
	 *
	 * @since    1.0.0
	 */
	public function header_add_to_cart_fragment( $fragments ) {
		ob_start();
		?>
			<i class='woo_mini-count'><?php echo '<span>' . esc_html( WC()->cart->cart_contents_count ) . '</span>'; ?></i>
		<?php
		$fragments['.woo_mini-count'] = ob_get_clean();

		ob_start();
			woocommerce_mini_cart();
		$fragments['div.woo_mini_cart'] = ob_get_clean();

		return $fragments;
	}

	/**
	 * Minicart wrapper open.
	 *
	 * @since    1.0.0
	 */
	public function minicart_wrapper_open() {
		echo '<div class="woo_mini_cart">';
	}

	/**
	 * Minicart wrapper close.
	 *
	 * @since    1.0.0
	 */
	public function minicart_wrapper_close() {
		echo '</div>';
	}

	/**
	 * Create minicart icon HTML.
	 *
	 * @since    1.0.0
	 */
	public function r1_woocommerce_get_mini_cart_icon() {
		ob_start();
		?>

		<a href="<?php echo esc_url( wc_get_cart_url() ); ?>">
			<img src="<?php echo esc_attr( get_template_directory_uri() ); ?>/assets/img/cart-icon-black.svg" alt="" />
			<i class='woo_mini-count'>
				<?php echo '<span>' . esc_html( WC()->cart->cart_contents_count ) . '</span>'; ?>
			</i>
		</a>

		<?php
		return ob_get_clean();
	}

	/**
	 * Create minicart HTML.
	 *
	 * @since    1.0.0
	 */
	public function r1_woocommerce_get_mini_cart() {
		ob_start();
		?>

		<div class="r1-header__menu__link mini-cart <?php echo esc_attr( get_theme_mod( 'woocommerce_mini_cart' ) ); ?> ">
			<?php
				echo wp_kses_post( $this->r1_woocommerce_get_mini_cart_icon() );
			?>
		</div>

		<?php
		return ob_get_clean();
	}

}
