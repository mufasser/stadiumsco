<?php

/**
 *
 * @link              https://mufasseirislam.com
 * @since             1.0.0
 * @package           Travel_Connection
 *
 * @wordpress-plugin
 * Plugin Name:       Travel Connection APIs
 * Plugin URI:        https://mufasseirislam.com
 * Description:       Travel Connection APIs integration
 * Version:           1.0.0
 * Author:            Mufasser Islam
 * Author URI:        https://mufasseirislam.com/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       travel-connection
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'TRAVEL_CONNECTION_VERSION', '1.0.0' );
define( 'TC_PLUGIN_DIR_PATH', plugin_dir_path( __FILE__ ) );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-travel-connection-activator.php
 */
function activate_travel_connection() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-travel-connection-activator.php';
	Travel_Connection_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-travel-connection-deactivator.php
 */
function deactivate_travel_connection() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-travel-connection-deactivator.php';
	Travel_Connection_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_travel_connection' );
register_deactivation_hook( __FILE__, 'deactivate_travel_connection' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-travel-connection.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_travel_connection() {

	$plugin = new Travel_Connection();
	$plugin->run();

}

run_travel_connection();
