<?php
if ( ! defined( 'ABSPATH' ) ) die("Nope, this shouldn't have happened.  fix it!");

// class wp-post get query to wordpress by custom post type
require_once PLUGIN_DIR_PATH.'includes/wp/class-vip-wp-base.php';

class VipWpEvent extends VipWpBase {
    
    // get all events

    private $eventID=0;
    // private $metaQueryFilters = [];

    function __construct(){
        parent::__construct();
    }

    // setters
    function setEventID($eventID){
        $this->eventID = $eventID;
    }

    // getters
    function getEventID(){
        return $this->eventID;
    }

    function getEvents($limit=-1){


        $eventQueryArgs = [
            'posts_per_page' => $limit,
            'post_type' => 'xs2_event',
            'post_status' => 'publish',
            'orderby' => 'title',
            'order' => 'ASC',
            'meta_query' => $this->getMetaQueryFilters()
        ];

        if($this->getEventID() > 0){
            $eventQueryArgs['ID'] = $this->getEventID();
        }

        $events = [];        
        $eventsList = get_posts($eventQueryArgs);

        if ( count($eventsList) > 0 ) {
            $i=0;
            foreach ($eventsList as $event) {
                $events[$i] = $event;
                $i++;
            }
        }
        return $events;
    }
    
    function isEventExist($eventID){
        return $this->isPostExist($eventID, 'event_id',  'xs2_event');
    }

    // getEventMetadata
    function getEventMetadata($eventID, $metaKey=''){

        if($metaKey){
            return get_field($metaKey, $eventID,  true);
        }
    }

    function __destruct() {

    }
}