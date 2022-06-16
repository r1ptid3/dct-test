<?php
/**
 * File which holds custom woocommerce class.
 *
 * @package Mokarabia
 */

// Disable direct access.
if ( ! defined( 'ABSPATH' ) ) {
	die;
}


/**
 * Class to customize woocommerce.
 *
 * @package    Mokarabia
 * @subpackage Mokarabia/woocommerce
 */
class R1_WooCommerce {

	/**
	 * Define the core functionality.
	 *
	 * @since    1.0.0
	 */
	public function __construct() {

		global $r1_woo_common;
		global $r1_woo_archive;

		$this->load_dependencies();

		// Register all of the hooks related to the common woocommerce functionality.
		$r1_woo_common = new R1_WooCommerce_Common();

		// Register all of the hooks related to the archive woocommerce functionality.
		$r1_woo_archive = new R1_WooCommerce_Archive();
	}

	/**
	 * Load the required dependencies for this class.
	 *
	 * @since    1.0.0
	 *
	 * @access   private
	 */
	private function load_dependencies() {

		/**
		 * The class responsible for all of the hooks related to the common woocommerce functionality.
		 */
		require 'inc/class-wc-common.php';

		/**
		 * The class responsible for all of the hooks related to the common woocommerce functionality.
		 */
		require 'inc/class-wc-archive.php';

	}

}

global $r1_woo;

$r1_woo = new R1_WooCommerce();
