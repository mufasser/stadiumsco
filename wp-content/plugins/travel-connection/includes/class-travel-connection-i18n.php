<?php
if ( ! defined( 'ABSPATH' ) ) die("Nope, this shouldn't have happened.  fix it!");

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https://mufasseirislam.com
 * @since      1.0.0
 *
 * @package    Travel_Connection
 * @subpackage Travel_Connection/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Travel_Connection
 * @subpackage Travel_Connection/includes
 * @author     Mufasser Islam <mufasseri@gmail.com>
 */
class Travel_Connection_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'travel-connection',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
