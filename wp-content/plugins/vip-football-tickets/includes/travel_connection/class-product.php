<?php

class Product extends Travel_Connection_API {


    public $page_size = 350;
    public $page=1;
    public $type = "football_match"; // Product Type. football_match
    public $search = ""; // Name or a part of the name of the products.
    public $modified_since = ""; // UTC epoch date seconds, events that modified or created after this value.
    public $start_date = ""; // UTC epoch date seconds, events that start on or after this value.
    public $end_date = ""; // UTC epoch date seconds, events that start on or before this value.
    public $is_confirmed = ""; // If true, will only return matches that have a confirmed start time.
    public $competition = ""; //  If supplied will filter the results by the supplied competition Ids.
    public $venue = ""; // If supplied, will filter the results by the supplied venue Ids.
    public $team = ""; // If supplied, will filter the results by the supplied team Ids.
    public $include_completed = ""; // If 1, will include matches for the current season where the product date & time have lapsed.
    public $supplier_id = ""; //supplier_id
    public $category_id = ""; //category_id
    public $sub_category = ""; //sub category such as sun_regular or weekend_youth
    public $category_type = ""; //category type filtering (generaladmission, grandstand, busparking, carparking, camping, transfer
    public $category_typeList = [
        "generaladmission"=>"General Admission",
        "grandstand"=>"Grand Stand",
        "busparking"=>"Bus Parking",
        "carparking"=>"Car Parking",
        "camping"=>"Camping",
        "camping"=>"Transfer"
    ]; //category type filtering (generaladmission, grandstand, busparking, carparking, camping, transfer

    private $pagination = [];

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

    function setProductType($type){
        $this->type = $type;
    }

    function setProductSearch($search){
        $this->search = $search;
    }

    function setProductModifiedSince($modified_since){
        $this->modified_since = $modified_since;
    }

    function setProductStartDate($start_date){
        $this->start_date = $start_date;
    }
    function setProductEndDate($end_date){
        $this->end_date = $end_date;
    }

    function setProductIsConfirmed($is_confirmed){
        $this->is_confirmed = $is_confirmed;
    }

    function setProductCompetition($competition){
        $this->competition = $competition;
    }

    function setProductVenue($venue){
        $this->venue = $venue;
    }

    function setProductIncludeCompleted($include_completed){
        $this->include_completed = $include_completed;
    }

    function setProductTeam($team){
        $this->team = $team;
    }

    function setSupplierId($supplier_id){
        $this->supplier_id = $supplier_id;
    }


    // getters

    function getPage(){
        return $this->page;
    }

    function getPageSize(){
        return $this->page_size;
    }


    function getProductType(){
        return $this->type;
    }

    function getProductSearch(){
        return $this->search;
    }

    function getProductModifiedSince(){
        return $this->modified_since;
    }

    function getProductStartDate(){
        return $this->start_date;
    }

    function getProductEndDate(){
        return $this->end_date;
    }

    function getProductIsConfirmed(){
        return $this->is_confirmed;
    }

    function getProductCompetition(){
        return $this->competition;
    }

    function getProductVenue(){
        return $this->venue;
    }

    function getProductTeam(){
        return $this->team;
    }

    function getProductIncludeCompleted(){
        return $this->include_completed;
    }

    

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



     // get remote country list
     function getTickets(){

        $data = [];

        if(!empty($this->getPage())){
            $data['page'] = $this->getPage();
        }
        
        if(!empty($this->getPageSize())){
            $data['page_size'] = $this->getPageSize();
        }

        if(!empty($this->getProductType())){
            $data['type'] = $this->getProductType();
        }

        if(!empty($this->getProductSearch())){
            $data['search'] = $this->getProductSearch();
        }

        if(!empty($this->getProductModifiedSince())){
            $data['modified_since'] = $this->getProductModifiedSince();
        }

        if(!empty($this->getProductStartDate())){
            $data['start_date'] = $this->getProductModifiedSince();
        }

        if(!empty($this->getProductEndDate())){
            $data['end_date'] = $this->getProductEndDate();
        }

        if(!empty($this->getProductIsConfirmed())){
            $data['is_confirmed'] = $this->getProductIsConfirmed();
        }

        if(!empty($this->getProductCompetition())){
            $data['competition'] = $this->getProductCompetition();
        }

        if(!empty($this->getProductVenue())){
            $data['venue'] = $this->getProductVenue();
        }

        if(!empty($this->getProductTeam())){
            $data['team'] = $this->getProductTeam();
        }

        if(!empty($this->getProductIncludeCompleted())){
            $data['include_completed'] = $this->getProductIncludeCompleted();
        }

        
        // print_r($data); exit;
        
        $response=  $this->getRequest('/product', $data);
        return $response;
    }
     function getTicketById($ticketId){

        // $data = ['venue_id'=>$venueId];
        $response=  $this->getRequest('/product/'.$ticketId);
        return $response;
    }

    function saveTicket($data){
        $postData = array(
            'post_title'    => $data->ticket_title,
            'post_content'  => '',
            'post_status'   => 'publish',
            'post_type'     => 'xs2_ticket',
        );
        $ticketID = wp_insert_post( $postData, false );
        $this->updateTicketMetadata($data, $ticketID);
        return $ticketID;
    }


    function updateTicket($data, $ticketID){
        $this->updateTicketMetadata($data, $ticketID);
    }
    function updateTicketMetadata($data, $post_id){

        update_field('type_ticket', $data->type_ticket, $post_id);
        update_field('ticket_status', $data->ticket_status, $post_id);
        update_field('ticket_validity', $data->ticket_validity, $post_id);
        update_field('event_id', $data->event_id, $post_id);
        update_field('description_supplier', $data->description_supplier, $post_id);
        update_field('information_shipping', $data->information_shipping, $post_id);
        update_field('currency_code', $data->currency_code, $post_id);
        update_field('ticket_validuntil', $data->ticket_validuntil, $post_id);
        update_field('ticket_validfrom', $data->ticket_validfrom, $post_id);
        update_field('min_order', $data->min_order, $post_id);
        update_field('ticket_stock', $data->stock, $post_id);
        update_field('supplier_id', $data->supplier_id, $post_id);
        update_field('external_ticket_id', $data->external_ticket_id, $post_id);
        update_field('ticket_id', $data->ticket_id, $post_id);
        update_field('ticket_title', $data->ticket_title, $post_id);
        update_field('ticket_id', $data->ticket_id, $post_id);
        update_field('ticket_targetgroup', $data->ticket_targetgroup, $post_id);
        update_field('category_id', $data->category_id, $post_id);
        update_field('category_type', $data->category_type, $post_id);
        update_field('sub_category', $data->sub_category, $post_id);
        update_field('category_name', $data->category_name, $post_id);
        update_field('net_rate', $data->net_rate, $post_id);
        update_field('face_value', $data->face_value, $post_id);
        update_field('created', $data->created, $post_id);
        update_field('updated', $data->updated, $post_id);
        update_field('supplier_terms', $data->supplier_terms, $post_id);
        update_field('category_information_available', $data->category_information_available, $post_id);
        update_field('supplier_role', $data->supplier_role, $post_id);
        update_field('sales_periods', json_encode($data->sales_periods), $post_id);
        update_field('options', json_encode($data->options), $post_id);
        update_field('flags', json_encode($data->flags), $post_id);
        update_field('eventdays', $data->eventdays, $post_id);
        update_field('is_xs2event_supplier', $data->is_xs2event_supplier, $post_id);
        update_field('local_rates', json_encode($data->local_rates), $post_id);        
        update_field('ticket_metadata', json_encode($data), $post_id);

    }

    function __destruct() {

    }


    
}