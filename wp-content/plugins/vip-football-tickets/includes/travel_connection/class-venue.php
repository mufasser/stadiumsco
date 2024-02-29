<?php

class Venue extends XS2Event_API {


    public int $page_size = 300; // integer: number of items per page (default: 10)
    public int $page=1; // integer: current page (default: 1)
    public string $country=""; // country id
    public string $venue_type="";
    public  $popular = "";
    public string $venue_name="";
    public string $slug="";

    function __construct( ) {
        parent::__construct();

    }
    
    // setter
    function setCountry($country){
        $this->country = $country;
    }

    function setVenueType($venue_type){
        $this->venue_type = $venue_type;
    }

    function setVenueName($venue_name){
        $this->venue_name = $venue_name;
    }

    function setSlug($slug){
        $this->slug = $slug;
    }

    function setPopular($popular){
        $this->popular = $popular;
    }

    function setPage($page){
        $this->page = $page;
    }

    function setPageSize($pageSize){
        $this->page_size = $pageSize;
    }

    // GETTERS

    function getPage(){
        return $this->page;
    }

    function getPageSize(){
        return $this->page_size;
    }

    function getCountry(){
        return $this->country;
    }

    function getVenueType(){
        return $this->venue_type;
    }

    function getVenueName(){
        return $this->venue_name;
    }

    function getSlug(){
        return $this->slug;
    }

    function getPopular(){
        return $this->popular;
    }

     // get remote country list
     function getVenues(){

        $data = [];

        if(!empty($this->getPage())){
            $data['page'] = $this->getPage();
        }

        if(!empty($this->getPageSize())){
            $data['page_size'] = $this->getPageSize();
        }

        if(!empty($this->getCountry())){
            $data['country'] = $this->getCountry();
        }

        if(!empty($this->getPopular())){
            $data['popular'] = $this->getPopular();
        }

        if(!empty($this->getVenueName())){
            $data['venue_name'] = $this->getVenueName();
        }

        if(!empty($this->getSlug())){
            $data['slug'] = $this->getSlug();
        }
    
        // print_r($data); exit;
        $response=  $this->getRequest('/venues', $data);
        return $response;
    }


     function getVenueById($venueId){

        // $data = ['venue_id'=>$venueId];
        $response=  $this->getRequest('/venues/'.$venueId);
        return $response;
    }

    // save venue in wordpress custom post type
    function saveVenue($data){

        if($data->official_name == 'unknown') return;

        $postData = array(
            'post_title'    => $data->official_name,
            'post_content'  => '',
            'post_status'   => 'publish',
            'post_type'     => 'xs2_venue',
        );
        $post_id = wp_insert_post( $postData, false );
        $this->saveVenueMetaData($data, $post_id);        
        return $post_id;
    }
    // update Venue
    function updateVenue($data, $wpVenueID){

        if($data->official_name == 'unknown') return;

        // $postData = array(
        //     'post_type'     => 'xs2_venue',
        //     'ID'=> $wpVenueID
        // );
        
        // $wpVenueID = wp_update_post( $postData, false );
        $this->saveVenueMetaData($data, $wpVenueID);        
        return $wpVenueID;
    }

    function saveVenueMetaData($data, $post_id){

        update_field('venue_id', $data->venue_id, $post_id);
        update_field('official_name', $data->official_name, $post_id);
        update_field('popular_stadium', (bool)$data->popular_stadium, $post_id);
        update_field('capacity', $data->capacity, $post_id);
        update_field('country', $data->country, $post_id);
        update_field('city', $data->city, $post_id);
        update_field('venue_type', $data->venue_type, $post_id);
        update_field('slug', $data->slug, $post_id);
        update_field('latitude', $data->latitude, $post_id);
        update_field('longitude', $data->longitude, $post_id);
        // update_field('venue_name', $data->venue_name, $post_id);
        update_field('venue_slug', $data->slug, $post_id);
        update_field('postalcode', $data->postalcode, $post_id);
        update_field('streetname', $data->streetname, $post_id);
        update_field('opened', $data->opened, $post_id);
        update_field('track_length', $data->track_length, $post_id);
        update_field('opened', $data->opened, $post_id);
        update_field('wikipedia_snippet', $data->wikipedia_snippet, $post_id);
        update_field('wikipedia_slug', $data->wikipedia_slug, $post_id);
        update_field('venue_metadata', json_encode($data), $post_id);

    }

    function __destruct() {

    }
    

}