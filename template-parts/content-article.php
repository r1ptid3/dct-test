<?php
/**
 * Template part for displaying post
 *
 * @param array $args :
 * [columns]    - layout to optimize image sizes;
 * [square_img] - to create, upload & use square image;
 * [length]     - content length;
 * [btn_title]  - "read more" button title;
 *
 * @package Dtc
 */

// Disable direct access.
if ( ! defined( 'ABSPATH' ) ) {
	die;
}

/*
 * Handling null values.
 * REQUIRED PHP 7.4
 */
$args['length'] ??= -1;

?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'r1-post' ); ?>>

	<?php if ( ! empty( r1_post_featured() ) ) : ?>

	<div class="post-featured-wrapper">
		<!-- post featured image -->
		<?php
			// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			echo r1_post_featured( esc_attr( $args['columns'] ), esc_attr( $args['square_img'] ) );
		?>

		<!-- post content -->
		<?php
			// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			echo r1_post_content( esc_attr( $args['btn_title'] ), (int) esc_attr( $args['length'] ) );
		?>
	</div>

	<?php endif; ?>

	<div class="post-meta">
		<!-- post date -->
		<?php echo wp_kses_post( r1_post_date() ); ?>
	</div>

	<!-- post title -->
	<?php echo wp_kses_post( r1_post_title() ); ?>

	<!-- post button -->
	<?php echo wp_kses_post( r1_post_read_more( esc_html__( 'More', 'dtc' ) ) ); ?>

</article>
