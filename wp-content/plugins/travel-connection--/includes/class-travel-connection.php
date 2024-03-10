<?php
if ( ! defined( 'ABSPATH' ) ) die("Nope, this shouldn't have happened.  fix it!");
/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       https://mufasseirislam.com
 * @since      1.0.0
 *
 * @package    Travel_Connection
 * @subpackage Travel_Connection/includes
 */

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.0.0
 * @package    Travel_Connection
 * @subpackage Travel_Connection/includes
 * @author     Mufasser Islam <mufasseri@gmail.com>
 */
class Travel_Connection {

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      Travel_Connection_Loader    $loader    Maintains and registers all hooks for the plugin.
	 */
	protected $loader;


	/**
	 * 
	 */
	protected $custom_table;

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $plugin_name    The string used to uniquely identify this plugin.
	 */
	protected $plugin_name;

	/**
	 * The current version of the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $version    The current version of the plugin.
	 */
	protected $version;

	/**
	 * Define the core functionality of the plugin.
	 *
	 * Set the plugin name and the plugin version that can be used throughout the plugin.
	 * Load the dependencies, define the locale, and set the hooks for the admin area and
	 * the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function __construct() {
		if ( defined( 'TRAVEL_CONNECTION_VERSION' ) ) {
			$this->version = TRAVEL_CONNECTION_VERSION;
		} else {
			$this->version = '1.0.0';
		}
		$this->plugin_name = 'travel-connection';

		$this->load_dependencies();
		$this->set_locale();
		$this->define_admin_hooks();
		$this->define_public_hooks();

	}

	/**
	 * Load the required dependencies for this plugin.
	 *
	 * Include the following files that make up the plugin:
	 *
	 * - Travel_Connection_Loader. Orchestrates the hooks of the plugin.
	 * - Travel_Connection_i18n. Defines internationalization functionality.
	 * - Travel_Connection_Admin. Defines all hooks for the admin area.
	 * - Travel_Connection_Public. Defines all hooks for the public side of the site.
	 *
	 * Create an instance of the loader which will be used to register the hooks
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function load_dependencies() {

		/**
		 * The class responsible for orchestrating the actions and filters of the
		 * core plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-travel-connection-loader.php';

		/**
		 * The class responsible for defining internationalization functionality
		 * of the plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-travel-connection-i18n.php';

		/**
		 * The class responsible for defining all actions that occur in the admin area.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-travel-connection-admin.php';

		/**
		 * the class responsible for show custom fields in listing table
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-travel-connection-tables.php';
		// $this->custom_table = new Vip_Football_Tickets_Tables();



		/**
		 * The class responsible for defining all actions that occur in the public-facing
		 * side of the site.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-travel-connection-public.php';

		$this->loader = new Travel_Connection_Loader();

	}

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the Vip_Football_Tickets_i18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function set_locale() {

		$plugin_i18n = new Vip_Football_Tickets_i18n();

		$this->loader->add_action( 'plugins_loaded', $plugin_i18n, 'load_plugin_textdomain' );

	}

	/**
	 * Register all of the hooks related to the admin area functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_admin_hooks() {

		$plugin_admin = new Vip_Football_Tickets_Admin( $this->get_plugin_name(), $this->get_version() );
		$plugin_admin_table = new Vip_Football_Tickets_Tables( );

		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_styles' );
		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts' );
		// add admin menu action
		$this->loader->add_action('admin_menu', $plugin_admin, 'vip_football_tickets_menu');
		

		// $this->loader->add_action('manage_tournament_posts_columns', $plugin_admin, 'set_custom_edit_tournament_columns');
		
		// define cron job hooks
		$this->loader->add_action('sync_vip_sync_city', $plugin_admin, 'vip_sync_city');
		$this->loader->add_action('sync_vip_sync_country', $plugin_admin, 'vip_sync_country');
		$this->loader->add_action('sync_vip_sync_venue', $plugin_admin, 'vip_sync_venue');
		$this->loader->add_action('sync_vip_sync_sport', $plugin_admin, 'vip_sync_sport');
		$this->loader->add_action('sync_vip_sync_team', $plugin_admin, 'vip_sync_team');
		$this->loader->add_action('sync_vip_sync_tournament', $plugin_admin, 'vip_sync_tournament');
		$this->loader->add_action('sync_vip_sync_ticket', $plugin_admin, 'vip_sync_ticket');
		
		
		// add custom table actions
		$this->loader->add_action('manage_tournament_posts_custom_column', $plugin_admin_table, 'custom_tournament_column', 10,2);
		$this->loader->add_action('manage_xs2_team_posts_custom_column', $plugin_admin_table, 'custom_xs2_team_column', 10,2);
		$this->loader->add_action('manage_xs2_event_posts_custom_column', $plugin_admin_table, 'custom_xs2_event_column', 10,2);

		// add filters
		$this->loader->add_filter('manage_tournament_posts_columns', $plugin_admin_table, 'set_custom_edit_tournament_columns');
		$this->loader->add_filter('manage_xs2_team_posts_columns', $plugin_admin_table, 'set_custom_edit_xs2_team_columns');
		$this->loader->add_filter('manage_xs2_event_posts_columns', $plugin_admin_table, 'set_custom_edit_xs2_event_columns');
		// add search filter
		$this->loader->add_filter('parse_query', $plugin_admin_table, 'event_parse_filter');
	}

	/**
	 * Register all of the hooks related to the public-facing functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_public_hooks() {

		$plugin_public = new Vip_Football_Tickets_Public( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_styles' );
		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_scripts' );

	}

	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 *
	 * @since    1.0.0
	 */
	public function run() {
		$this->loader->run();
	}

	/**
	 * The name of the plugin used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 *
	 * @since     1.0.0
	 * @return    string    The name of the plugin.
	 */
	public function get_plugin_name() {
		return $this->plugin_name;
	}

	/**
	 * The reference to the class that orchestrates the hooks with the plugin.
	 *
	 * @since     1.0.0
	 * @return    Vip_Football_Tickets_Loader    Orchestrates the hooks of the plugin.
	 */
	public function get_loader() {
		return $this->loader;
	}

	/**
	 * Retrieve the version number of the plugin.
	 *
	 * @since     1.0.0
	 * @return    string    The version number of the plugin.
	 */
	public function get_version() {
		return $this->version;
	}

}
