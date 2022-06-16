<?php
/**
 * The template for displaying all pages
 *
 * @package Dtc
 */

// Disable direct access.
if ( ! defined( 'ABSPATH' ) ) {
	die;
}

get_header();
?>

<?php if ( have_rows( 'banner_slides' ) ) : ?>
	<section class="r1-banner">

		<?php while( have_rows( 'banner_slides' ) ): the_row(); // phpcs:ignore

			$image       = get_sub_field( 'image' );
			$banner_link = get_sub_field( 'slide_link' );

			if ( ! empty( $image ) && $banner_link ) {
				$link_url    = $banner_link['url'];
				$link_title  = $banner_link['title'];
				$link_target = $banner_link['target'] ? $banner_link['target'] : '_self';

				echo '<a class="r1-banner__slide" style="background-image: url(' . esc_url( $image ) . ');" href="' . esc_url( $link_url ) . '" target="' . esc_attr( $link_target ) . '">' . esc_html( $link_title ) . '</a>';
			}

			?>

		<?php endwhile; ?>

	</section>
<?php endif; ?>

<?php if ( ! empty( get_field( 'categories' ) ) ) : ?>
	<section class="r1-categories">

	<?php foreach ( get_field( 'categories' ) as $category ) : ?>
		<a href="<?php echo get_term_link( $category->term_id, 'product_cat' ); //phpcs:ignore ?>" class="r1-categories__item">
		<?php
			$thumbnail_id = get_term_meta( $category->term_id, 'thumbnail_id', true );
			echo wp_get_attachment_image( $thumbnail_id, 'full' );
		?>
		</a>
	<?php endforeach; ?>

	</section>
<?php endif; ?>

<?php if ( isset( get_field( 'show_recent_products' )[0] ) && 'yes' === ( get_field( 'show_recent_products' )[0] ) ) : ?>
	<section class="r1-recent-products">
		<div class="r1-container">

			<?php if ( ! empty( get_field( 'recent_title' ) ) ) : ?>
			<div class="r1-title-wrapper">
				<h3 class="r1-title"><?php echo esc_html( get_field( 'recent_title' ) ); ?></h3>
			</div>
			<?php endif; ?>

			<?php echo do_shortcode( '[recent_products limit="12"]' ); ?>

		</div>
	</section>
<?php endif; ?>

<?php if ( have_rows( 'best_sellers_categories' ) ) : ?>
	<section class="r1-best-sellers">
		<div class="r1-container">

			<?php if ( ! empty( get_field( 'best_sellers_title' ) ) ) : ?>
			<div class="r1-title-wrapper">
				<h3 class="r1-title"><?php echo esc_html( get_field( 'best_sellers_title' ) ); ?></h3>
			</div>
			<?php endif; ?>

			<?php while( have_rows( 'best_sellers_categories' ) ): the_row(); // phpcs:ignore ?>
				<div class="r1-best-sellers__row">
					<?php echo do_shortcode( '[products columns="3" best_selling category="' . get_sub_field( 'category' )->slug . '" limit="9"]' ); ?>

					<?php if ( ! empty( get_sub_field( 'advertising_image' ) ) ) : ?>
						<a class="best-sellers-category" href="<?php echo get_term_link( get_sub_field( 'category' )->term_id, 'product_cat' ); //phpcs:ignore ?>">
							<?php echo r1_acf_image( 'advertising_image', true ); // phpcs:ignore ?>
						</a>
					<?php endif; ?>
				</div>
			<?php endwhile; ?>

		</div>
	</section>
<?php endif; ?>

<?php if ( isset( get_field( 'show_special_products' )[0] ) && 'yes' === ( get_field( 'show_special_products' )[0] ) ) : ?>
	<section class="r1-special-products">
		<div class="r1-container">

			<?php if ( ! empty( get_field( 'special_title' ) ) ) : ?>
			<div class="r1-title-wrapper">
				<h3 class="r1-title"><?php echo esc_html( get_field( 'special_title' ) ); ?></h3>
			</div>
			<?php endif; ?>

			<?php echo do_shortcode( '[products visibility="featured" class="specials" columns="3" limit="6"]' ); ?>

		</div>
	</section>
<?php endif; ?>

<?php if ( have_rows( 'services' ) ) : ?>
	<section class="r1-services" style="background-image: url(<?php echo esc_url( get_field( 'services_background' ) ); ?>);">
		<div class="r1-container">

			<?php while( have_rows( 'services' ) ): the_row(); // phpcs:ignore ?>
				<div class="r1-services__item">

					<?php
					if ( ! empty( get_sub_field( 'icon' ) ) ) {
						echo r1_acf_image( 'icon', true ); // phpcs:ignore
					}
					if ( ! empty( get_sub_field( 'title' ) ) ) {
						echo '<h5>' . esc_html( get_sub_field( 'title' ) ) . '</h5>';
					}
					if ( ! empty( get_sub_field( 'decription' ) ) ) {
						echo '<p>' . wp_kses_post( get_sub_field( 'decription' ) ) . '</p>';
					}
					?>

				</div>
			<?php endwhile; ?>

		</div>
	</section>
<?php endif; ?>

<?php if ( isset( get_field( 'show_latest_blog' )[0] ) && 'yes' === ( get_field( 'show_latest_blog' )[0] ) ) : ?>
	<section class="r1-blog">
		<div class="r1-container">

			<?php if ( ! empty( get_field( 'blog_title' ) ) ) : ?>
			<div class="r1-title-wrapper">
				<h3 class="r1-title"><?php echo esc_html( get_field( 'blog_title' ) ); ?></h3>
			</div>
			<?php endif; ?>

			<?php

			$args = array(
				'orderby'        => 'date',
				'order'          => 'DESC',
				'post_type'      => 'post',
				'posts_per_page' => '3',
			);

			$latest = new WP_Query( $args );

			if ( $latest->have_posts() ) :
				?>

			<section class="r1-section-posts grid columns-3 ?>">
				<?php
				while ( $latest->have_posts() ) {
					$latest->the_post();

					get_template_part(
						'template-parts/content',
						'article',
						array(
							'columns'    => '3',
							'square_img' => false,
							'btn_title'  => esc_html__( 'More', 'dtc' ),
							'length'     => 0,
						)
					);
				}
				?>
			</section>

				<?php
			endif;
			?>

		</div>
	</section>

<?php endif; ?>

<?php
get_footer();
