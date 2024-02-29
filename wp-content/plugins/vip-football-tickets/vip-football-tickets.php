<?php

/**
 *
 * @link              https://mufasseirislam.com
 * @since             1.0.0
 * @package           Vip_Football_Tickets
 *
 * @wordpress-plugin
 * Plugin Name:       VIP Football Tickets
 * Plugin URI:        https://mufasseirislam.com
 * Description:       Football APIs integration
 * Version:           1.0.0
 * Author:            Mufasser Islam
 * Author URI:        https://mufasseirislam.com/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       vip-football-tickets
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
define( 'VIP_FOOTBALL_TICKETS_VERSION', '1.0.0' );
define( 'PLUGIN_DIR_PATH', plugin_dir_path( __FILE__ ) );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-vip-football-tickets-activator.php
 */
function activate_vip_football_tickets() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-vip-football-tickets-activator.php';
	Vip_Football_Tickets_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-vip-football-tickets-deactivator.php
 */
function deactivate_vip_football_tickets() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-vip-football-tickets-deactivator.php';
	Vip_Football_Tickets_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_vip_football_tickets' );
register_deactivation_hook( __FILE__, 'deactivate_vip_football_tickets' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-vip-football-tickets.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_vip_football_tickets() {

	$plugin = new Vip_Football_Tickets();
	$plugin->run();

}
run_vip_football_tickets();
