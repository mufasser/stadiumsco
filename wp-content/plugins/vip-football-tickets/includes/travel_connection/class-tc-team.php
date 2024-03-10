<?php
require_once PLUGIN_DIR_PATH.'includes/class-travel-connection-api.php'; 


class Tc_Team extends Travel_Connection_API {

    private $_endpoint = 'teams';

    public int $page_size = 350; // integer: number of items per page (default: 10)
    public int $page = 1; // integer: current page (default: 1)
    public string $team_slug = ""; // integer: slug of the team according to https://liaison.reuters.com/tools/sports-team-codes
    public string $team_name = ""; // string: name of the club
    // public bool $popular = true; // boolean: show popular clubs (most bookings)
    // public bool $club_logo = true; // boolean: show teams with club logo
    public string $sport_type=""; // string: sport type (soccer, tennis, motorsport, darts, rugby, etc etc)
    public string $slug = ""; // string: seo friendly alternative to uuid
    public string $iso_country = ""; // string: filter teams on their (ISO 3166-1 alpha-3) country of origin
    public string $event_startdate = ""; // string: Only returns teams which are linked to events with a startdate matching this criteria
    // public bool $interesting = true; // boolean: filter interesting teams

    private $tournament_id = 0;

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
/*
    function setTeamSlug($team_slug){
        $this->team_slug = $team_slug;
    }

    function setTeamName($team_name){
        $this->team_name = $team_name;
    }

    function setPopular($popular){
        // $this->popular = $popular;
    }

    function setClubLogo($club_logo){
        // $this->club_logo = $club_logo;
    }

    function setSportType($sport_type){
        $this->sport_type = $sport_type;
    }

    function setSlug($slug){
        $this->slug = $slug;
    }

    function setIsoCountry($iso_country){
        $this->iso_country = $iso_country;
    }

    function setEventStartdate($event_startdate){
        $this->event_startdate = $event_startdate;
    }

    function setInteresting($interesting){
        // $this->interesting = $interesting;
    }

    function setTournamentId($tournament_id){
        $this->tournament_id = $tournament_id;
    }
*/
    // GETTERS

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

    function getTeamSlug(){
        return $this->team_slug;
    }

    function getTeamName(){
        return $this->team_name;
    }

    function getPopular(){
        // return $this->popular;
    }

    function getClubLogo(){
        // return $this->club_logo;
    }

    function getSportType(){
        return $this->sport_type;
    }

    function getSlug(){
        return $this->slug;
    }

    function getIsoCountry(){
        return $this->iso_country;
    }

    function getEventStartdate(){
        return $this->event_startdate;
    }

    function getInteresting(){
        // return $this->interesting;
    }
    
    function getTournamentId(){
        return $this->tournament_id;
    }

    function fetchTeams(){
        $response = [];
        $teams =  json_decode($this->getRequest($this->_endpoint, []), true);
        $teamsList = $teams['data'];
        $totalTeams = $teams['total'];
        $to = $teams['to'];
        $limit = $teams['per_page'];
        //page[number]
        if(isset($teams['data'])){
            $response = $teams['data'];
        }
        return $response;
    }

/*
     // get remote country list
     function _getTeams(){

        $data = [];

        if(!empty($this->getPage())){
            $data['page'] = $this->getPage();
        }
        
        if(!empty($this->getPageSize())){
            $data['page_size'] = $this->getPageSize();
        }

        if(!empty($this->getTeamSlug())){
            $data['team_slug'] = $this->getTeamSlug();
        }

        if(!empty($this->getTeamName())){
            $data['team_name'] = $this->getTeamName();
        }

        if(!empty($this->getPopular())){
            $data['popular'] = $this->getPopular();
        }

        if(!empty($this->getClubLogo())){
            $data['club_logo'] = $this->getClubLogo();
        }

        if(!empty($this->getSportType())){
            $data['sport_type'] = $this->getSportType();
        }

        if(!empty($this->getSlug())){
            $data['slug'] = $this->getSlug();
        }

        if(!empty($this->getIsoCountry())){
            $data['iso_country'] = $this->getIsoCountry();
        }

        if(!empty($this->getEventStartdate())){
            $data['event_startdate'] = $this->getEventStartdate();
        }

        if(!empty($this->getInteresting())){
            $data['interesting'] = $this->getInteresting();
        }
        if(!empty($this->getTournamentId())){
            $data['tournament_id'] = $this->getTournamentId();
        }
        
        $response=  $this->getRequest('/teams', $data);
        return $response;
    }
    */

     function getTeamById($teamId){

        // $data = ['venue_id'=>$venueId];
        $response=  $this->getRequest('/teams/'.$teamId);
        return $response;
    }

    function saveTeam($data){

        $postData = array(
            'post_title'    => $data->official_name,
            'post_content'  => '',
            'post_status'   => 'draft',
            'post_type'     => 'xs2_team',
        );
        $post_id = wp_insert_post( $postData, false );
        //save custom data 
        $this->saveTeamMetaData($data, $post_id);

    }

    function updateTeam($data, $post_id){

        // $postData = array(
        //     'post_title'    => $data->official_name,
        //     'post_content'  => '',
        //     'post_status'   => 'draft',
        //     'post_type'     => 'xs2_team',
        // );
        // $post_id = wp_update_post( $postData, false );
        //save custom data 
        $this->saveTeamMetaData($data, $post_id);
    }

    function saveTeamMetaData($data, $post_id){

        update_field('official_name', $data->official_name, $post_id);
        update_field('team_id', $data->team_id, $post_id);
        update_field('popular_team', $data->popular_team, $post_id);
        update_field('wikipedia_slug', $data->wikipedia_slug, $post_id);
        update_field('wikipedia_snippet', $data->wikipedia_snippet, $post_id);
        update_field('team_slug', $data->slug, $post_id);
        update_field('sport_type', $data->sport_type, $post_id);
        update_field('logo_filename', $data->logo_filename, $post_id);
        update_field('iso_country', $data->iso_country, $post_id);
        update_field('team_metadata', json_encode($data), $post_id);

    }


    function __destruct() {

    }
}