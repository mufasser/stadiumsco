<?php
if ( ! defined( 'ABSPATH' ) ) die("Nope, this shouldn't have happened.  fix it!");

// class wp-post get query to wordpress by custom post type
require_once PLUGIN_DIR_PATH.'includes/wp/class-vip-wp-base.php';

class VipWpTicket extends VipWpBase {
    
    // get all tickets

    private $ticketID=0;
    // private $metaQueryFilters = [];

    function __construct(){
        parent::__construct();
    }

    // setters
    function setTicketID($ticketID){
        $this->ticketID = $ticketID;
    }

    // getters
    function getTicketID(){
        return $this->ticketID;
    }

    function getTickets($limit=-1){


        $ticketQueryArgs = [
            'posts_per_page' => $limit,
            'post_type' => 'xs2_ticket',
            'post_status' => 'publish',
            'orderby' => 'title',
            'order' => 'ASC',
            'meta_query' => $this->getMetaQueryFilters()
        ];

        if($this->getTicketID() > 0){
            $ticketQueryArgs['ID'] = $this->getTicketID();
        }

        $tickets = [];        
        $ticketsList = get_posts($ticketQueryArgs);

        if ( count($ticketsList) > 0 ) {
            $i=0;
            foreach ($ticketsList as $ticket) {
                $tickets[$i] = $ticket;
                $i++;
            }
        }
        return $tickets;
    }
    
    function isTicketExist($ticketID){
        return $this->isPostExist($ticketID, 'ticket_id',  'xs2_ticket');
    }

    // getTicketMetadata
    function getTicketMetadata($ticketID, $metaKey=''){

        if($metaKey){
            return get_field($ticketID, $metaKey, true);
        }
    }

    function __destruct() {

    }
}