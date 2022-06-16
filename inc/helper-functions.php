<?php
/**
 * Helper functions.
 *
 * @package Dtc
 */

// Enable strict typing mode.
declare( strict_types = 1 );

// Disable direct access.
if ( ! defined( 'ABSPATH' ) ) {
	die;
}

if ( ! function_exists( 'rzr_acf_image' ) ) {

	/**
	 * Output acf image.
	 *
	 * @since   1.0.0
	 *
	 * @param   string       $field - ACF field id.
	 * @param   bool         $sub   - Is the field sub-field.
	 * @param   string       $class - Add extra classes.
	 * @param   string | int $extra - Options page or ID.
	 *
	 * @return  void
	 */
	function r1_acf_image( string $field, bool $sub = false, string $class = '', $extra = '' ) {
		if ( empty( $field ) ) {
			return;
		}

		if ( ! empty( $extra ) ) {
			$image = get_field( $field, $extra );
		} elseif ( $sub ) {
			$image = get_sub_field( $field );
		} else {
			$image = get_field( $field );
		}

		$alt = ! empty( $image['alt'] ) ? esc_attr( $image['alt'] ) : esc_attr( $image['title'] );

		if ( ! empty( $image ) ) {
			if ( ! empty( $class ) ) {
				$out = '<img class="' . $class . '" src="' . $image['url'] . '" alt="' . $alt . '" />';
			} else {
				$out = '<img src="' . $image['url'] . '" alt="' . $alt . '" />';
			}
		} else {
			return;
		}

		return $out;
	}
}
