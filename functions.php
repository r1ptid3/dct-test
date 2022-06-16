<?php
/**
 * Functions and definitions
 *
 * @package Dtc
 *
 * @since   1.0.0
 */

// Enable strict typing mode.
declare( strict_types = 1 );

// Disable direct access.
if ( ! defined( 'ABSPATH' ) ) {
	die;
}

if ( ! defined( 'R1__VERSION' ) ) {
	// Replace the version number of the theme on each release.
	// define( 'R1__VERSION', '1.0.0' );
	define( 'R1__VERSION', uniqid('test_') );
}

if ( ! function_exists( 'dtc_setup' ) ) {
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * @since  1.0.0
	 *
	 * @return void
	 */
	function dtc_setup(): void {

		// Make theme available for translation.
		load_theme_textdomain( 'dtc', get_template_directory() . '/languages' );

		// Let WordPress manage the document title.
		add_theme_support( 'title-tag' );

		// Enable support for Post Thumbnails on posts and pages.
		add_theme_support( 'post-thumbnails' );

		// Register theme menu locations.
		register_nav_menus(
			array(
				'main-menu' => 'Primary',
				'footer-1' => 'Footer Menu 1',
				'footer-2' => 'Footer Menu 2',
				'footer-3' => 'Footer Menu 3',
			)
		);

		// Switch default core markup for search form, comment form, and comments to output valid HTML5.
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'style',
				'script',
			)
		);

		// Set up the WordPress core custom background feature.
		add_theme_support(
			'custom-background',
			apply_filters(
				'dtc_custom_background_args',
				array(
					'default-color' => 'ffffff',
					'default-image' => '',
				)
			)
		);
	}
}

add_action( 'after_setup_theme', 'dtc_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * @global int $content_width
 *
 * @return void
 */
function dtc_content_width(): void {
	$GLOBALS['content_width'] = apply_filters( 'dtc_content_width', 1170 );
}
add_action( 'after_setup_theme', 'dtc_content_width', 0 );

/**
 * Register widget area
 *
 * @since    1.0.0
 *
 * @return  void
 */
function dtc_widgets_init(): void {
	register_sidebar(
		array(
			'name'          => 'Sidebar',
			'id'            => 'sidebar-1',
			'description'   => 'Add widgets here.',
			'before_widget' => '<div id="%1$s" class="r1-widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h4 class="r1-widget__title">',
			'after_title'   => '</h4>',
		)
	);
}
add_action( 'widgets_init', 'dtc_widgets_init' );

/**
 * Register the theme assets
 *
 * @since   1.0.0
 *
 * @return  void
 */
function dtc_assets(): void {
	// Theme's styles.
	wp_enqueue_style(
		'slick',
		get_template_directory_uri() . '/assets/css/slick.css',
		array(),
		R1__VERSION,
		'all'
	);
	wp_enqueue_style(
		'dtc-theme',
		get_template_directory_uri() . '/assets/css/main.css',
		array( 'slick' ),
		R1__VERSION,
		'all'
	);

	// Theme's scripts.
	wp_enqueue_script(
		'slick-slider',
		get_template_directory_uri() . '/assets/js/slick.min.js',
		array( 'jquery' ),
		'3.1.1',
		false
	);
	wp_enqueue_script(
		'dtc-scripts',
		get_template_directory_uri() . '/assets/js/common.js',
		array( 'slick-slider' ),
		R1__VERSION,
		true
	);

	// Enqueue comment reply script.
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'dtc_assets' );

/**
 * Create ACF Option pages for each language.
 *
 * @since  1.0.0
 */
if ( class_exists( 'ACF' ) ) {

	// Add same code below for each language.
	acf_add_options_sub_page(
		array(
			'page_title' => 'Options En',
			'menu_title' => 'Options En',
			'menu_slug'  => 'options-en',
			'post_id'    => 'options-en',
		)
	);

}


/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/hooking-functions.php';

/**
 * Custom blog functions which output post sections.
 */
require get_template_directory() . '/inc/post-functions.php';

/**
 * Functions which are adjust or change WordPress functions.
 */
require get_template_directory() . '/inc/wp-functions.php';

/**
 * Custom theme functions.
 */
require get_template_directory() . '/inc/theme-functions.php';

/**
 * Helper functions.
 */
require get_template_directory() . '/inc/helper-functions.php';

/**
 * Woocommerce.
 */
if ( class_exists( 'WooCommerce' ) ) {
	require get_template_directory() . '/woocommerce/wooinit.php';
}
