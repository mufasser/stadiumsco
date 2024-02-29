<?php
if ( ! defined( 'ABSPATH' ) ) die("Nope, this shouldn't have happened.  fix it!");

// class wp-post get query to wordpress by custom post type
require_once PLUGIN_DIR_PATH.'includes/wp/class-vip-wp-base.php';

class VipWpVenue extends VipWpBase {
    
    // get all venues

    private $venueID=0;


    function __construct(){
        parent::__construct();
    }

    // setters
    function setVenueID($venueID){
        $this->venueID = $venueID;
    }

    // getters
    function getVenueID(){
        return $this->venueID;
    }

    function getVenues($limit=-1){


        $venueQueryArgs = [
            'posts_per_page' => $limit,
            'post_type' => 'xs2_venue',
            'post_status' => 'publish',
            'orderby' => 'title',
            'order' => 'ASC',
            'meta_query' => $this->getMetaQueryFilters()
        ];
        $venues = [];        
        $venuesList = get_posts($venueQueryArgs);

        if ( count($venuesList) > 0 ) {
            $i=0;
            foreach ($venuesList as $venue) {
                $venues[$i] = $venue;
                $i++;
            }
        }
        return $venues;
    }
    
    function isVenueExist($venueID){

        $venue = $this->isPostExist($venueID, 'venue_id', 'xs2_venue');
        // var_dump($venue);
        return $venue;
        // // print_r($data); exit;
        // $venueQueryArgs = [
        //     'post_type' => 'xs2_venue',
        //     'posts_per_page' => 1,
        //     'meta_query' => [[
        //         'key' => 'venue_id',
        //         'value' => $venueID,
        //         'compare' => '='
        //         ]],
        //     ];

        // $venueQuery = new WP_Query($venueQueryArgs);
        // if($venueQuery->found_posts > 0) {
        //     return true;
        // }
        // return false;
    }

    function __destruct() {

    }
}