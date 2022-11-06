<?php
/**
	* Plugin Name: 	RTE Rodonaves Shipping
	* Plugin URI: 
	* Description: 	Plugin add RTE Rodonaves Shippging to WooCommerce.
	* Version: 		0.0.1
	* Author: 		Paulo Cezario
	* License:		GPLv2 or later
	* Text Domain: 	woocommerce-rte-rodonaves-shipping
	* Domain Path:  /languages
	* Author URI: 	https://github.com/phscezario/
	*
	*Este plugin adiciona o sistema de frete RTE Rodonaves a sua loja virtual Wordpress com WooCommerce.
**/

/** If this file is called directly, abort. */
defined('ABSPATH') || die();

define( 'RTE_SHIPPING_METHOD_FILE', __FILE__ );
define('RTE_SHIPPING_BASE_PATH', __DIR__);

/** Define token to access */
define( 'RTE_JWT', '');

/*
 * Check if Class exist
 */
if ( ! class_exists( 'RteShipping' ) ) {
    include_once dirname( __FILE__ ) . '/includes/class-wc-rte-shipping.php';
    add_action( 'plugins_loaded', array( 'RteShipping', 'init' ) );
	add_action( 'wp_enqueue_scripts', 'add_assets' );
	add_action( 'admin_enqueue_scripts', 'add_admin_assets' );
	add_action( 'woocommerce_enqueue_styles', 'add_user_assets' );
}

function add_assets() {
	if ( is_product() ) {
		wp_enqueue_style( 'rte-shipping-styles', plugin_dir_url( __FILE__ ) . 'assets/css/rte-shipping-styles.css' );
		wp_enqueue_script( 'rte-shipping-scripts', plugin_dir_url( __FILE__ ) . 'assets/js/rte-shipping-scripts.js', array( 'jquery' ), '', true );
		wp_localize_script('rte-shipping-scripts', 'rteShippingData', array(
			'url' => admin_url('admin-ajax.php'),
			'action' => 'get_shipping', 
			'text' => array(
				'estimated'		=> __( 'Estimated Time', 'woocommerce-rte-rodonaves-shipping' ),
				'days'			=> __( 'working day(s)', 'woocommerce-rte-rodonaves-shipping' ),
				'error'			=> __( 'Entry a correct postcode.', 'woocommerce-rte-rodonaves-shipping' ),
				'postcode'		=> __( 'Postcode', 'woocommerce-rte-rodonaves-shipping' ),
				'adversity'		=> __( 'Maybe you need to calculate shipping again after change product variation or quantity.', 'woocommerce-rte-rodonaves-shipping')
			)
		));
	}
}

function add_admin_assets() {
	wp_enqueue_style( 'rte-shipping-admin-styles', plugin_dir_url( __FILE__ ) . 'assets/css/rte-shipping-admin-styles.css' );
}

function add_user_assets() {
	wp_enqueue_style( 'rte-shipping-admin-styles', plugin_dir_url( __FILE__ ) . 'assets/css/rte-shipping-user-styles.css' );
}