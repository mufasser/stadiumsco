<?php

class VipEvent extends XS2Event_API {

    public $page_size = 1000; // integer: page number
    public $page = 1; // integer: page number
    public $sport_type = "soccer"; // string: sport_type
    public $tournament_type  = ""; // string: tournament_type
    public $date_start  = ""; // string: date_start
    public $date_stop  = ""; // string: date_stop
    public $venue_id  = ""; // string: venue_id
    public $event_id  = ""; // string: event_id
    public $tournament_id  = ""; // string: tournament_id
    public $team_id  = ""; // string: team_id
    public $hometeam_id  = ""; // string: hometeam_id  
    public $visitingteam_id  = ""; // string: visitingteam_id
    public $city  = ""; // string: city
    public $location_id  = ""; // string: events related to a specific location id (can be venue, city, ..)
    public $event_status  = ""; // string: notstarted / closed / opened
    public $country  = "GBR"; // string: country only UK
    public $event_name  = ""; // string: event_name
    public $tournament_name  = ""; // string: tournament name
    public $tickets_available  = ""; // integer: number of tickets available for this event (on category level)
    public $booked  = ""; // boolean: show only events which have had bookings
    public $popular_events  = ""; // boolean: show all the popular events
    public $ticket_price_eur  = ""; // integer: ticket_price_eur
    public $slug  = ""; // string: slug
    public $ios_country  = ""; // string: get events only for this country in ios

    public $pagination = array();

    function __construct( ) {
        parent::__construct();
    }

    // setter

    function setPagination($pagination){
        $this->pagination = $pagination;
    }

    function setPage($page){
        $this->page = $page;
    }

    function setPageSize($pageSize){
        $this->page_size = $pageSize;
    }

    function setSportType($sport_type){
        $this->sport_type = $sport_type;
    }

    function setTournamentType($tournament_type){
        $this->tournament_type = $tournament_type;
    }

    function setDateStart($date_start){
        $this->date_start = $date_start;
    }

    function setDateStop($date_stop){
        $this->date_stop = $date_stop;
    }

    function setVenueId($venue_id){
        $this->venue_id = $venue_id;
    }

    function setEventId($event_id){
        $this->event_id = $event_id;
    }

    function setTournamentId($tournament_id){
        $this->tournament_id = $tournament_id;
    }

    function setTeamId($team_id){
        $this->team_id = $team_id;
    }

    function setHometeamId($hometeam_id){
        $this->hometeam_id = $hometeam_id;
    }

    function setVisitingteamId($visitingteam_id){
        $this->visitingteam_id = $visitingteam_id;
    }

    function setCity($city){
        $this->city = $city;
    }

    function setLocationId($location_id){
        $this->location_id = $location_id;
    }

    function setEventStatus($event_status){
        $this->event_status = $event_status;
    }

    function setCountry($country){
        $this->country = $country;
    }

    function setEventName($event_name){
        $this->event_name = $event_name;
    }

    function setTournamentName($tournament_name){
        $this->tournament_name = $tournament_name;
    }

    function setTicketsAvailable($tickets_available){
        $this->tickets_available = $tickets_available;
    }

    function setBooked($booked){
        $this->booked = $booked;
    }

    function setPopularEvents($popular_events){
        $this->popular_events = $popular_events;
    }

    function setTicketPriceEur($ticket_price_eur){
        $this->ticket_price_eur = $ticket_price_eur;
    }

    function setSlug($slug){
        $this->slug = $slug;
    }

    function setIosCountry($ios_country){
        $this->ios_country = $ios_country;
    }

    // getters

    function getPagination(){
        return $this->pagination;
    }

    function getTotalPages(){
        $pagination = $this->getPagination();
        $total_size = $pagination->total_size;
        $page_size = $pagination->page_size;
        if($page_size == 0){
            return 0;
        }
        return ceil($total_size / $page_size);
    }

    function getPage(){
        return $this->page;
    }

    function getPageSize(){
        return $this->page_size;
    }

    function getSportType(){
        return $this->sport_type;
    }

    function getTournamentType(){
        return $this->tournament_type;
    }

    function getDateStart(){
        return $this->date_start;
    }

    function getDateStop(){
        return $this->date_stop;
    }

    function getVenueId(){
        return $this->venue_id;
    }

    function getEventId(){
        return $this->event_id;
    }

    function getTournamentId(){
        return $this->tournament_id;
    }

    function getTeamId(){
        return $this->team_id;
    }

    function getHometeamId(){
        return $this->hometeam_id;
    }

    function getVisitingteamId(){
        return $this->visitingteam_id;
    }

    function getCity(){
        return $this->city;
    }

    function getLocationId(){
        return $this->location_id;
    }

    function getEventStatus(){
        return $this->event_status;
    }

    function getCountry(){
        return $this->country;
    }

    function getEventName(){
        return $this->event_name;
    }

    function getTournamentName(){
        return $this->tournament_name;
    }

    function getTicketsAvailable(){
        return $this->tickets_available;
    }

    function getBooked(){
        return $this->booked;
    }

    function getPopularEvents(){
        return $this->popular_events;
    }

    function getTicketPriceEur(){
        return $this->ticket_price_eur;
    }

    function getSlug(){
        return $this->slug;
    }

    function getIosCountry(){
        return $this->ios_country;
    }

     // get remote country list
     function getEvents(){

        $data = [];

        if(!empty($this->getPage())){
            $data['page'] = $this->getPage();
        }
        
        if(!empty($this->getPageSize())){
            $data['page_size'] = $this->getPageSize();
        }

        if(!empty($this->getSportType())){
            $data['sport_type'] = $this->getSportType();
        }

        if(!empty($this->getTournamentType())){
            $data['tournament_type'] = $this->getTournamentType();
        }

        if(!empty($this->getDateStart())){
            $data['date_start'] = $this->getDateStart();
        }

        if(!empty($this->getDateStop())){
            $data['date_stop'] = $this->getDateStop();
        }

        if(!empty($this->getVenueId())){
            $data['venue_id'] = $this->getVenueId();
        }

        if(!empty($this->getEventId())){
            $data['event_id'] = $this->getEventId();
        }

        if(!empty($this->getTournamentId())){
            $data['tournament_id'] = $this->getTournamentId();
        }

        if(!empty($this->getTeamId())){
            $data['team_id'] = $this->getTeamId();
        }

        if(!empty($this->getHometeamId())){
            $data['hometeam_id'] = $this->getHometeamId();
        }

        if(!empty($this->getVisitingteamId())){
            $data['visitingteam_id'] = $this->getVisitingteamId();
        }

        if(!empty($this->getCity())){
            $data['city'] = $this->getCity();
        }

        if(!empty($this->getLocationId())){
            $data['location_id'] = $this->getLocationId();
        }

        if(!empty($this->getEventStatus())){
            $data['event_status'] = $this->getEventStatus();
        }

        if(!empty($this->getCountry())){
            $data['country'] = $this->getCountry();
        }

        if(!empty($this->getEventName())){
            $data['event_name'] = $this->getEventName();
        }

        if(!empty($this->getTournamentName())){
            $data['tournament_name'] = $this->getTournamentName();
        }

        if(!empty($this->getTicketsAvailable())){
            $data['tickets_available'] = $this->getTicketsAvailable();
        }

        if(!empty($this->getBooked())){
            $data['booked'] = $this->getBooked();
        }

        if(!empty($this->getPopularEvents())){
            $data['popular_events'] = $this->getPopularEvents();
        }

        if(!empty($this->getTicketPriceEur())){
            $data['ticket_price_eur'] = $this->getTicketPriceEur();
        }

        if(!empty($this->getSlug())){
            $data['slug'] = $this->getSlug();
        }

        if(!empty($this->getIosCountry())){
            $data['ios_country'] = $this->getIosCountry();
        }

        
        
        $response=  $this->getRequest('/events', $data);
        return $response;
    }
     function getEventById($eventId){

        // $data = ['venue_id'=>$venueId];
        $response=  $this->getRequest('/events/'.$eventId);
        return $response;
    }

    // Get the guestdata requirements for a specific event
     function getEventGuestDataByEventId($eventId){

        // $data = ['venue_id'=>$venueId];
        $response=  $this->getRequest('/events/'.$eventId.'/guestdata');
        return $response;
    }

    
    function saveEvent($data){

        if(empty($data->event_name)){
            return;
        }
        $postData = array(
            'post_title'    => $data->event_name,
            'post_content'  => $data->event_description??"",
            'post_status'   => 'publish',
            'post_type'     => 'xs2_event',
        );
        $post_id = wp_insert_post( $postData, false );
        $this->saveEventMetaData($data, $post_id);
    }

    function saveEventMetaData($data, $post_id){

        update_field('event_id', $data->event_id, $post_id);
        update_field('event_name', $data->event_name, $post_id);
        update_field('event_description', $data->event_description, $post_id);
        update_field('event_status', $data->event_status, $post_id);
        update_field('date_start', $data->date_start, $post_id);
        update_field('date_stop', $data->date_stop, $post_id);
        update_field('date_confirmed', $data->date_confirmed, $post_id);
        update_field('tournament_id', $data->tournament_id, $post_id);
        update_field('hometeam_id', $data->hometeam_id, $post_id);
        update_field('hometeam_name', $data->hometeam_name, $post_id);
        update_field('visitingteam_id', $data->visiting_id, $post_id);
        update_field('visiting_team_name', $data->visiting_name, $post_id);
        update_field('tournament_name', $data->tournament_name, $post_id);
        update_field('venue_name', $data->venue_name, $post_id);
        update_field('venue_id', $data->venue_id, $post_id);
        update_field('location_id', $data->location_id, $post_id);
        update_field('city', $data->city, $post_id);
        update_field('iso_country', $data->iso_country, $post_id);
        update_field('latitude', $data->latitude, $post_id);
        update_field('longitude', $data->longitude, $post_id);
        update_field('sport_type', $data->sport_type, $post_id);
        update_field('is_popular', $data->is_popular, $post_id);
        update_field('number_of_tickets', $data->number_of_tickets, $post_id);
        update_field('min_ticket_price_eur', $data->min_ticket_price_eur, $post_id);
        update_field('max_ticket_price_eur', $data->max_ticket_price_eur, $post_id);
        update_field('sales_periods', json_encode($data->sales_periods), $post_id);
        update_field('created', $data->created, $post_id);
        update_field('updated', $data->updated, $post_id);
        update_field('event_metadata', json_encode($data), $post_id);

    }

    function updateEvent($data, $eventID){
        // $postData = array(
        //     'ID'   => $eventID,
        //     'post_status'   => 'publish',
        // );
        // $post_id = wp_update_post( $postData, false );
        $this->saveEventMetaData($data, $eventID);
    }



    function __destruct() {
        $this->setTournamentId("");
      }

    
}