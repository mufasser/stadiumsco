<?php
ini_set('memory_limit', '-1');
ini_set('max_execution_time', 3600);

require_once TC_PLUGIN_DIR_PATH.'utils/class-utils.php';
/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://mufasseirislam.com
 * @since      1.0.0
 *
 * @package    Vip_Football_Tickets
 * @subpackage Vip_Football_Tickets/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Travel_Connection_Admin
 * @subpackage Travel_Connection_Admin/admin
 * @author     Mufasser Islam <mufasseri@gmail.com>
 */
class Travel_Connection_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */

	 private $utils = null;
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;
		$this->utils = new Utils();

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/travel-connection-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/travel-connection-admin.js', array( 'jquery' ), $this->version, false );

	}

	public function vip_football_tickets_menu() {

		add_menu_page( 'VIP Football Tickets', 'VIP Football Tickets', 'manage_options', 'vip-football-tickets', array( $this, 'vip_football_tickets_page' ), 'dashicons-clipboard', 99 );
		add_submenu_page( 'vip-football-tickets', 'VIP Football Tickets', 'Settings', 'manage_options', 'vip-football-tickets', array( $this, 'vip_football_tickets_page' ) );

		// add_action( 'admin_init', array( $this, 'vip_football_tickets_page_init' ) );
	}

	public function vip_football_tickets_page() {
		
		// create City Class instance
		require_once TC_PLUGIN_DIR_PATH.'includes/xs2event/class-city.php'; 
		require_once TC_PLUGIN_DIR_PATH.'includes/xs2event/class-country.php'; 
		require_once TC_PLUGIN_DIR_PATH.'includes/xs2event/class-venue.php'; 

		
		// sync data
		// $this->vip_sync_venue();
		// $this->vip_sync_team();
		$this->vip_sync_tournament();
		// $this->vip_sync_event();
		// $this->vip_sync_ticket();


		require_once plugin_dir_path( __FILE__ ) . '/partials/vip-football-tickets-admin-display.php';
	}

	function vip_sync_city(){
		// fetch and sync Cities
		require_once PLUGIN_DIR_PATH.'includes/xs2event/class-city.php';
		$city = new City();
		$cities = $city->getCities();
	}

	function vip_sync_country(){
		// fetch and sync Countries
		require_once PLUGIN_DIR_PATH.'includes/xs2event/class-country.php';
		$country = new Country();
		$countries = $country->getCountry();
	}

	function vip_sync_venue(){
		// fetch and sync Venues
		require_once PLUGIN_DIR_PATH.'includes/xs2event/class-venue.php';
		require_once PLUGIN_DIR_PATH.'includes/wp/class-vip-wp-venue.php';
		$vipWpVenue = new VipWpVenue();
		$venue = new Venue();
		$venue->setCountry('GBR');
		$venue->setVenueType('stadium');
		$venue->setPageSize(200);
		$venuesList = $venue->getVenues();
		$venuesList = json_decode($venuesList);
		foreach($venuesList->venues as $venueData){
			if($vipWpVenue->isVenueExist($venueData->venue_id)){
				// reset meta query filters array
				$vipWpVenue->resetMetaQueryFilters();
				$vipWpVenue->addMetaQueryFilter([
					'key' => 'venue_id',
					'value' => $venueData->venue_id,
					'compare' => '='
				]);
				// die("Existing Venue: ".$venueData->venue_id);
				$wpVenuesList = $vipWpVenue->getVenues();
				// update venue
				$venue->updateVenue($venueData, $wpVenuesList[0]->ID);
			}else{
				$venue->saveVenue($venueData);
			}
		}
	}

	function vip_sync_sport(){
		// fetch and sync Sport
		require_once PLUGIN_DIR_PATH.'includes/xs2event/class-sport.php';
		$sport = new Sport();
		$sportsList = $sport->getSports();

	}

	function vip_sync_tournament(){

		// fetch and sync Tournament
		require_once PLUGIN_DIR_PATH.'includes/xs2event/class-tournament.php';
		require_once PLUGIN_DIR_PATH.'includes/wp/class-vip-wp-tournament.php';
		$wpTournament = new VipWpTournament();
		$tournament = new Tournament();
		$tournament->setRegion("GBR");
		$tournament->setDateStop("gt:".date("Y-m-d"));
		$allTournamentsList = $tournament->getTournaments();

		// $this->utils->printFormateArray($allTournamentsList, true); 

		foreach($allTournamentsList as $tKey => $tournamentObject){
			$tournamentsList = json_decode($tournamentObject);
			foreach($tournamentsList->tournaments as $tournamentData){

				// skip those tournament which has similar words in tournament name
				if(
					in_array($tournamentData->official_name, $tournament->skipTournamentList) ||
					count($tournamentsList->tournaments) == 0
					){
					continue;
				}

				// $isTournament = $wpTournament->isTournamentExist($tournamentData->tournament_id);
				$isTournament = $wpTournament->isTournamentExist($tournamentData->official_name, 'official_name');
				if($isTournament){
					$wpTournament->resetMetaQueryFilters();
					$wpTournament->addMetaQueryFilter([
						'key' => 'tournament_id',
						'value' => $tournamentData->tournament_id,
						'compare' => '='
					]);
					$wpTournamentList = $wpTournament->getTournaments();
					// print_r($allTournamentsList); exit;
					// echo $tournamentObject['local_data'][0]['primary_color'];
					$tournament->updateTournament($tournamentData, $wpTournamentList[0]->ID);
				}else{
					// echo $tournamentObject['local_data'][0]['primary_color'];
					$tournament->saveTournament($tournamentData);
				}
			}
		}
	}

	function vip_sync_event(){
		// fetch and sync Event
		require_once PLUGIN_DIR_PATH.'includes/xs2event/class-event.php';
		require_once PLUGIN_DIR_PATH.'includes/wp/class-vip-wp-team.php';
		require_once PLUGIN_DIR_PATH.'includes/wp/class-vip-wp-event.php';
		require_once PLUGIN_DIR_PATH.'includes/wp/class-vip-wp-tournament.php';
		$wpEvent = new VipWpEvent();
		$wpTeam = new VipWpTeam();
		$teamIDs = $wpTeam->getAllTeamIDs();
		$this->utils->printFormateArray($teamIDs); // print team ids
		// $dates = $this->utils->getTwoDatesFromPeriods('30', '30');

		// get wp tournaments list
		$wpTournament = new VipWpTournament();
		$wpTournamentList = $wpTournament->getTournaments();
		// $this->utils->printFormateArray($wpTournamentList, true);
		foreach($wpTournamentList as $wpTournamentData){

			$event = new VipEvent();
			$event->setDateStop('gt:'.date("Y-m-d"));
			// $is_tournament_id_exist_in_event = $wpEvent->getEventMetadata($wpTournamentData->ID, 'tournament_id');
			$tournament_id = $wpTournament->getTournamentMetadata($wpTournamentData->ID, 'tournament_id');
			
			// $this->utils->printFormateArray($tournament_id, true);

			$event->setPageSize(1000);
			$event->setTournamentId($tournament_id);
			$eventsList = json_decode($event->getEvents());
			$event->setPagination( $eventsList->pagination );
			$totalPages = $event->getTotalPages();
			if($totalPages == 0) continue;
			
			// $this->utils->printFormateArray($eventsList, true);
			foreach($eventsList->events as $eventData){

				// echo "Event Data: \n";
				// $this->utils->printFormateArray($eventData);
				// skip event if team id not found
				if(!in_array($eventData->hometeam_id, $teamIDs) || !in_array($eventData->visiting_id, $teamIDs)) continue;

				// echo 'EVENT FOUND';
				// $this->utils->printFormateArray($eventData, true);
				// $this->utils->printFormateArray($eventData);


				
				$isEvent = $wpEvent->isEventExist($eventData->event_id);
				if($isEvent){
					$wpEvent->resetMetaQueryFilters();
					$wpEvent->addMetaQueryFilter([
						'key' => 'event_id',
						'value' => $eventData->event_id,
						'compare' => '='
					]);
					$wpEventList = $wpEvent->getEvents();
					$event->updateEvent($eventData, $wpEventList[0]->ID);
				}else{
					$event->saveEvent($eventData);
				}
			}
		}
	}

	function vip_sync_team(){

		// echo "TEAM";

		// fetch and sync Team
		require_once PLUGIN_DIR_PATH.'includes/xs2event/class-team.php';
		require_once PLUGIN_DIR_PATH.'includes/wp/class-vip-wp-team.php';
		require_once PLUGIN_DIR_PATH.'includes/wp/class-vip-wp-tournament.php';

		$wpTeam = new VipWpTeam();
		$wpTournament = new VipWpTournament();
		$wpTournamentList = $wpTournament->getTournaments();

		// loop on tournaments because we have to load on only tournament's team
		foreach($wpTournamentList as $wpTournamentData){

			$team = new Team();
			$tournament_id = $wpTournament->getTournamentMetadata($wpTournamentData->ID, 'tournament_id');
			if($tournament_id == '') continue;
			
			// print
			// echo 'Tournament ID: '.$tournament_id; exit;
			// $this->utils->printFormateArray($tournament_id, true);

			$team->setPageSize(250);
			$team->setTournamentId($tournament_id);
			$teamsList = $team->getTeams();
			$teamsList = json_decode($teamsList);
			$team->setPagination( $teamsList->pagination );
			$totalPages = $team->getTotalPages();
			if($totalPages == 0) continue;

			foreach($teamsList->teams as $teamData){

				$isTeam = $wpTeam->isTeamExist($teamData->team_id);
				
				// var_dump( $isTeam ); exit;
				
				if($isTeam){

					$wpTeam->resetMetaQueryFilters();
					$wpTeam->addMetaQueryFilter([
						'key' => 'team_id',
						'value' => $ticketData->team_id,
						'compare' => '='
					]);
					$wpTeamList = $wpTeam->getTeams();
					$team->updateTeam($teamData, $wpTeamList[0]->ID);

					$team->updateTeam($teamData, $teamData->team_id);
				}else{
					$team->saveTeam($teamData);
				}
			}	
		}
	}

	// sync tickets
	function vip_sync_ticket(){
		// fetch and sync Tickets
		require_once PLUGIN_DIR_PATH.'includes/xs2event/class-ticket.php';
		require_once PLUGIN_DIR_PATH.'includes/wp/class-vip-wp-ticket.php';
		require_once PLUGIN_DIR_PATH.'includes/wp/class-vip-wp-event.php';

		// die("here");

		$wpTicket = new VipWpTicket();
		// get events because all tickets are in events
		$wpEvent = new VipWpEvent();
		$wpEventList = $wpEvent->getEvents();
		// $this->utils->printFormateArray($wpEventList, true);
		foreach($wpEventList as $wpEventData){

			$event_id = $wpEvent->getEventMetadata($wpEventData->ID, 'event_id');
			echo "ID:".$wpEventData->ID. "<br>";
			echo "Event_ID:".$event_id;
			if($event_id == '') continue;

			$ticket = new Ticket();
			$ticket->setEventId($event_id);
			$ticketsList = $ticket->getTickets();
			$ticketsList = json_decode($ticketsList);

			// print
			// $this->utils->printFormateArray($ticketsList);
			// continue on empty ticket list
			if(count($ticketsList->tickets) == 0) continue;

			$ticket->setPagination( $ticketsList->pagination );
			$totalPages = $ticket->getTotalPages();
			if($totalPages == 0) continue;

			foreach($ticketsList->tickets as $ticketData){

				// $this->utils->printFormateArray($ticketData, true);

				$isTicket = $wpTicket->isTicketExist($ticketData->ticket_id);
				if($isTicket){

					$wpTicket->resetMetaQueryFilters();
					$wpTicket->addMetaQueryFilter([
						'key' => 'ticket_id',
						'value' => $ticketData->ticket_id,
						'compare' => '='
					]);
					$wpTicketList = $wpTicket->getTickets();
					$ticket->updateTicket($ticketData, $wpTicketList[0]->ID);

				}else{
					$ticket->saveTicket($ticketData);
				}
			}	
		}
	}

	function vip_sync_category(){
		// fetch and sync Category
		require_once PLUGIN_DIR_PATH.'includes/xs2event/class-category.php';
		$category = new Category();
		$categoryList = $category->getCategories();
	}

	function vip_sync_xs2_api(){
		// call all function which need sync
		// wp_mail("mufasseri@gmail.com", "Sync run on VIP", "Welcome to VIP");
	}

}
