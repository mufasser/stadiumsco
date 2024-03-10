<?php

require_once PLUGIN_DIR_PATH.'utils/class-utils.php';
require_once PLUGIN_DIR_PATH.'includes/class-travel-connection-api.php'; 

class Tc_Tournament extends Travel_Connection_API  {

    private $_endpoint = 'competitions';

    // public $page_size = 300; // integer: number of items per page (default: 10)
    // public $page = 1; // integer: current page (default: 1)
    // public $region = ""; // string: iso country. For F1/Moto use "world"
    // public $date_start = ""; // string: date start
    // public $date_stop; // string: date stop. For F1/Moto use "now"; // string: date_stop
    // public $sport_type = "soccer"; // string: soccer, motogp, tennis,rugby, darts, boxing, formula1
    // public $tournament_type = ""; // string: tournament_type: league /cup
    // public $tournament_name = ""; // string: tournament name
    // public $official_name = ""; // string: official name
    // public $season = ""; // string: season

    public $tournamentList;
    public $skipTournamentList;

    private $utils;
    function __construct( ) {
        parent::__construct();
        $this->utils = new Utils();
        // $this->setRegion("GBR");
        // $this->setDateStop("gt:".date("Y-m-d"));
        // $this->setTournamentList([
        //     ["name"=>"Premier League", "primary_color"=>"#3D195B", "secondary_color"=>"#FFFFF"],
        //     ["name"=>"FA Cup", "primary_color"=>"#D71921", "secondary_color"=>"#C1C5C6"],
        //     ["name"=>"Carabao Cup", "primary_color"=>"#00935D", "secondary_color"=>"#FFFFFF"],
        //     ["name"=>"Champions League", "primary_color"=>"#010040", "secondary_color"=>"#FFFFFF"],
        //     ["name"=>"Europa League", "primary_color"=>"#00000", "secondary_color"=>"#FF6900"],
        //     ["name"=>"Conference League", "primary_color"=>"#00000", "secondary_color"=>"#00BE14"],
        //     ["name"=>"Championship", "primary_color"=>"#B69B40", "secondary_color"=>"#00138A"],
        //     ["name"=>"Scottish Premier League", "primary_color"=>"#19284E", "secondary_color"=>"#FBB22E"],
        //     ["name"=>"International", "primary_color"=>"#2957AE", "secondary_color"=>"#E21115"],
        //     ["name"=>"International", "primary_color"=>"#2957AE", "secondary_color"=>"#E21115"],

        //     // "FA Cup",
        //     // "Carabao Cup",
        //     // "Champions League",
        //     // "Europa League",
        //     // "Conference League",
        //     // "Championship",
        //     // "Scottish Premier League",
        //     // "International"
        // ]);

        $this->skipTournamentList = [
            "Premier League Scotland"
        ];
    }
/*

    function setTournamentList($tournamentList){
        $this->tournamentList = $tournamentList;
    }
    // setter

    function setPage($page){
        $this->page = $page;
    }

    function setPageSize($pageSize){
        $this->page_size = $pageSize;
    }

    function setRegion($region){
        $this->region = $region;
    }

    function setDateStart($date_start){
        $this->date_start = $date_start;
    }

    function setDateStop($date_stop){
        $this->date_stop = $date_stop;
    }

    function setSportType($sport_type){
        $this->sport_type = $sport_type;
    }

    function setTournamentType($tournament_type){
        $this->tournament_type = $tournament_type;
    }

    function setTournamentName($tournament_name){
        $this->tournament_name = $tournament_name;
    }


    // getters
    function getPage(){
        return $this->page;
    }

    function getPageSize(){
        return $this->page_size;
    }

    function getRegion(){
        return $this->region;
    }

    function getDateStart(){
        return $this->date_start;
    }

    function getDateStop(){
        return $this->date_stop;
    }

    function getSportType(){
        return $this->sport_type;
    }

    function getTournamentType(){
        return $this->tournament_type;
    }

    function getTournamentName(){
        return $this->tournament_name;
    }

    // get tournament list
    function getTournamentList(){

        return $this->tournamentList;
    }

    */

     // get remote country list
     function fetchTournaments(){

        $response = [];
        $tournaments =  json_decode($this->getRequest($this->_endpoint, []), true);

        if(isset($tournaments['data'])){
            $response = $tournaments['data'];
        }
        return $response;
     }

     function syncTournaments($tournaments){

        // update $tournaments on post_type tournament by foreach loop

        foreach($tournaments as $tournament){
            // print_r($tournament); exit;

            $this->saveTournament($tournament);
        }  

        $tournaments =  $this->getRequest($this->_endpoint, []);
        $response = json_decode($tournaments, true);
        return $response;
     }
/*
     function _getTournaments(){

        $data = [];

        if(!empty($this->getPage())){
            $data['page'] = $this->getPage();
        }
        
        if(!empty($this->getPageSize())){
            $data['page_size'] = $this->getPageSize();
        }

        if(!empty($this->getRegion())){
            $data['region'] = $this->getRegion();
        }

        if(!empty($this->getDateStart())){
            $data['date_start'] = $this->getDateStart();
        }

        if(!empty($this->getDateStop())){
            $data['date_stop'] = $this->getDateStop();
        }

        if(!empty($this->getSportType())){
            $data['sport_type'] = $this->getSportType();
        }

        if(!empty($this->getTournamentType())){
            $data['tournament_type'] = $this->getTournamentType();
        }

        if(!empty($this->getTournamentName())){
            $data['tournament_name'] = $this->getTournamentName();
        }

        $response = [];
        if(!empty($this->getTournamentList())){
            $tournament_list = $this->getTournamentList();
            $i=0;
            for($t=0; $t < count($tournament_list); $t++){
                
                $this->setTournamentName($tournament_list[$t]["name"]);
                $response[$i]['local_data'] = $tournament_list[$t];
                $data['tournament_name'] = $this->getTournamentName();
                $this->setTournamentName("");
                $response[$i] =  $this->getRequest('/tournaments', $data);
                $i++;
            }
        }
        return $response;
    }
    */
     function getTournamentById($tournamentId){
        
        // $data = ['venue_id'=>$venueId];
        $response=  $this->getRequest('/competitions/'.$tournamentId);
        return $response;
    }

    function saveTournament($data){

        $postData = array(
            'post_title'    => $data['name'],
            'post_content'  => '',
            'post_status'   => 'pending',
            'post_type'     => 'tournament',
        );
        $postID = wp_insert_post( $postData, false );
        $this->saveTournamentMetadata($postID, $data);
    }

    function updateTournament($data, $postID){
        // $postData = [
        //     'ID' => $postID
        // ];
        // wp_update_post($postData);
        $this->saveTournamentMetadata($postID, $data);
    }

    function saveTournamentMetadata($postID, $data){

        //save custom_field
        // $official_name = acf_get_field( 'official_name' );
        update_field( 'official_name', $data['name'], $postID);
        update_field( 'tournament_id', $data['id'], $postID);
        // update_field( 'season', $data->season, $postID);
        // update_field( 'tournament_type', $data->tournament_type, $postID);
        // update_field( 'region', $data->region, $postID);
        // update_field( 'sport_type', $data->sport_type, $postID);
        // update_field( 'date_start', $data->date_start, $postID);
        // update_field( 'date_stop', $data->date_stop, $postID);
        // update_field( 'created', $data->created, $postID);
        // update_field( 'updated', $data->updated, $postID);
        // update_field( 'number_events', $data->number_events, $postID);
        // update_field( 'slug', $data->slug, $postID);
        // update_field( 'tournament_metadata',json_encode($data), $postID);

    }

    function __destruct() {

    }

}