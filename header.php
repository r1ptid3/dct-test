<?php
/**
 * The template for displaying the header
 *
 * This is the template that displays all of the <head> section and everything up until main.
 *
 * @package Dtc
 *
 * @since   1.0.0
 */

// Disable direct access.
if ( ! defined( 'ABSPATH' ) ) {
	die;
}

global $r1_woo_common;

$options = function_exists( 'pll_current_language' ) ? 'options-' . pll_current_language( 'slug' ) : 'options-en';

?>

<!DOCTYPE html>
<html <?php language_attributes(); ?>>

	<head>
		<meta charset="<?php bloginfo( 'charset' ); ?>">

		<meta name="viewport" content="user-scalable=1.0, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0">
		<meta name="apple-mobile-web-app-capable" content="yes">
		<meta name="format-detection" content="telephone=no">

		<?php wp_head(); ?>
	</head>

	<body <?php body_class(); ?>>

		<!-- .r1-preloader -->
		<div class="r1-preloader"></div>
		<!-- \.r1-preloader -->

		<!-- .r1-header -->
		<header class="r1-header">
			<div class="r1-header__container r1-container">
				<div class="r1-header__top-bar">
					<h1 class="r1-header__top-bar__logo">
						<a href="<?php echo esc_url( get_home_url( '' ) ); ?>">
							<?php echo r1_acf_image( 'logotype', false, '', $options ) ? r1_acf_image( 'logotype', false, '', $options ) : get_bloginfo( 'name' ); // phpcs:ignore ?>
						</a>
					</h1>
				</div>
				<div class="r1-header__menu">
					<div class="r1-header__menu__links right">
						<a href="javascript:;" class="r1-header__menu__link search-link">
							<img src="<?php echo get_template_directory_uri() . '/assets/img/search-icon.svg'; // phpcs:ignore ?>" alt="search">
						</a>
						<?php get_product_search_form( true ); ?>
					</div>
					<div class="r1-header__menu__logo">
						<a href="<?php echo esc_url( get_home_url( '' ) ); ?>">
							<?php echo r1_acf_image( 'logotype', false, '', $options ) ? r1_acf_image( 'logotype', false, '', $options ) : get_bloginfo( 'name' ); // phpcs:ignore ?>
						</a>
					</div>
					<nav class="r1-header__menu__nav">
						<?php

						wp_nav_menu(
							array(
								'theme_location' => 'main-menu',
								'container'      => '',
							)
						);

						?>
					</nav>
					<div class="r1-header__menu__links left">
						<?php if ( class_exists( 'WooCommerce' ) ) : ?>
							<?php echo wp_kses_post( $r1_woo_common->r1_woocommerce_get_mini_cart() ); ?>
						<?php endif; ?>
						<a href="javascript:" class="r1-header__menu__link mobile-menu-trigger">
							<span></span>
							<span></span>
							<span></span>
						</a>
					</div>
				</div>
			</div>
		</header>

		<div class="r1-overlay"></div>
		<!-- \.r1-header -->

		<!-- .r1-content-wrapper -->
		<div class="r1-content-wrapper">

			<?php

			if ( is_singular( 'post' ) ) {
				get_sidebar();
			}

			?>

			<!-- .r1-main -->
			<main class="r1-main">
