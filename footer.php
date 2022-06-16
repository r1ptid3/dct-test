<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the .r1-main <main> tag and all content after.
 *
 * @package Dtc
 *
 * @since   1.0.0
 */

// Disable direct access.
if ( ! defined( 'ABSPATH' ) ) {
	die;
}

$options = function_exists( 'pll_current_language' ) ? 'options-' . pll_current_language( 'slug' ) : 'options-en';

?>

			</main>
			<!-- \.r1-main -->

		</div>
		<!-- \.r1-content-wrapper -->

		<!-- .r1-footer -->
		<footer class="r1-footer">
			<div class="r1-container">
				<div class="r1-footer__inner-wrapper">
					<div class="r1-footer__description">
						<?php echo r1_acf_image( 'logotype', false, '', $options ) ? r1_acf_image( 'logotype', false, '', $options ) : get_bloginfo( 'name' ); // phpcs:ignore ?>
						<?php echo get_field( 'footer_description', $options ) ? '<div>' . wp_kses_post( get_field( 'footer_description', $options ) ) . '</div>' : ''; ?>
						<?php if ( have_rows( 'socials', $options ) ) : ?>
						<nav class="socials">
							<h4><?php esc_html_e( 'FOLLOW US', 'dtc' ); ?></h4>
							<ul>
								<?php while( have_rows( 'socials', $options ) ): the_row(); // phpcs:ignore ?>
								<li>
									<a href="<?php echo esc_url( get_sub_field( 'link' ) ); ?>" target="_blank">
										<?php echo r1_acf_image( 'icon', true ); // phpcs:ignore ?>
									</a>
								</li>
								<?php endwhile; ?>
							</ul>
						</nav>
						<?php endif; ?>
					</div>

					<?php if ( ! empty( get_field( 'newsletter_form', $options ) ) ) : ?>
					<div class="r1-footer__newsletter">
						<h4><?php esc_html_e( 'NEWSLETTER SIGNUP', 'dtc' ); ?></h4>
						<?php echo do_shortcode( get_field( 'newsletter_form', $options ) ); ?>
					</div>
					<?php endif; ?>


					<?php
					$theme_locations = get_nav_menu_locations();

					$footer_menu_1 = get_term( $theme_locations['footer-1'], 'nav_menu' );
					$footer_menu_2 = get_term( $theme_locations['footer-2'], 'nav_menu' );
					$footer_menu_3 = get_term( $theme_locations['footer-3'], 'nav_menu' );
					?>
					<div class="r1-footer__menus">
						<nav class="r1-footer__menu">
							<h4><?php echo esc_html( $footer_menu_1->name ); ?></h4>
							<?php
							wp_nav_menu(
								array(
									'theme_location' => 'footer-1',
									'container'      => false,
								)
							);
							?>
						</nav>
						<nav class="r1-footer__menu">
							<h4><?php echo esc_html( $footer_menu_2->name ); ?></h4>
							<?php
							wp_nav_menu(
								array(
									'theme_location' => 'footer-2',
									'container'      => false,
								)
							);
							?>
						</nav>
						<nav class="r1-footer__menu">
							<h4><?php echo esc_html( $footer_menu_3->name ); ?></h4>
							<?php
							wp_nav_menu(
								array(
									'theme_location' => 'footer-3',
									'container'      => false,
								)
							);
							?>
						</nav>
					</div>
				</div>
				<div class="r1-footer__copyrights">
					<p>
						<?php
						// translators: %s - php year.
						printf( esc_html__( 'Copyright © %s Cloth-store. All Rights Reserved', 'dtc' ), esc_html( gmdate( 'Y' ) ) );
						?>
					</p>
					<a href="#"><?php esc_html_e( 'Designed by Solwin Infotech', 'dtc' ); ?></a>
				</div>
			</div>
		</footer>
		<!-- \.r1-footer -->

		<?php wp_footer(); ?>
	</body>

</html>
