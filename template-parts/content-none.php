<?php
/**
 * Template part for displaying a message that posts cannot be found
 *
 * @package Dtc
 */

// Disable direct access.
if ( ! defined( 'ABSPATH' ) ) {
	die;
}

?>

<section class="r1-section-no-results">
	<div class="r1-container">
		<div class="r1-title-wrapper">
			<h1 class="r1-title"><?php esc_html_e( 'Nothing Found', 'dtc' ); ?></h1>
		</div>

		<?php

		if ( is_home() && current_user_can( 'publish_posts' ) ) :

			printf(
				'<p>' . wp_kses(
					/* translators: 1: link to WP admin new post page. */
					__( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'dtc' ),
					array(
						'a' => array(
							'href' => array(),
						),
					)
				) . '</p>',
				esc_url( admin_url( 'post-new.php' ) )
			);

		elseif ( is_search() ) :
			?>

			<p><?php esc_html_e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'dtc' ); ?></p>
			<?php
			get_search_form();

		else :
			?>

			<p><?php esc_html_e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'dtc' ); ?></p>
			<?php
			get_search_form();

		endif;

		?>

	</div>
</section>
