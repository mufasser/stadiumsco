<?php

namespace Vip_Football_Elementor;

/**
 * Plugin Name: Vip Football Elementor
 * Description: Custom Elementor addon.
 * Plugin URI:  https://mufassirislam.com/
 * Version:     1.0.0
 * Author:      Mufasser Isalm
 * Author URI:  https://elementor.mufasserislam.com/
 * Text Domain: vip-football-elementor
 *
 * Elementor tested up to: x.x.x
 * Elementor Pro tested up to: x.x.x
 */


 if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}


 function vip_football_elementor() {

	// Load plugin file
	require_once( __DIR__ . '/includes/widgets-manager.php' );
	require_once( __DIR__ . '/includes/controls-manager.php' );

    // Run the plugin
	\Vip_Football_Elementor\Plugin::instance();


}
add_action( 'plugins_loaded', 'elementor_test_addon' );