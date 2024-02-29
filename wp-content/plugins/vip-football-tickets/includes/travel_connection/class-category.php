<?php
require_once PLUGIN_DIR_PATH.'includes/class-xs2event-api.php'; 
class Category extends XS2Event_API {

    public int $page_size  = 20;
    public int $page = 1;
    public string $venue_id = "";
    public string $event_id = "";
    public string $supplier_id = "";
    public string $sport_type = ""; //show only categories with have descriptions
    public string $country = ""; //country iso-3
    public string $venue_name = ""; //venue name
    public string $category_name = ""; //category_name
    public string $on_svg = ""; //on_svg
    public string $category_id = ""; //category_id
    public string $slug = ""; //slug

    // getter page_size

    function getPage(){
        return $this->page;
    }

    function getPageSize(){
        return $this->page_size;
    }

    function getVenueId(){
        return $this->venue_id;
    }

    function getEventId(){
        return $this->event_id;
    }

    function getSupplierId(){
        return $this->supplier_id;
    }

    function getSportType(){
        return $this->sport_type;
    }

    function getCountry(){
        return $this->country;
    }

    function getVenueName(){
        return $this->venue_name;
    }

    function getCategoryName(){
        return $this->category_name;
    }

    function getOnSvg(){
        return $this->on_svg;
    }

    function getCategoryId(){
        return $this->category_id;
    }

    function getSlug(){
        return $this->slug;
    }

    // setters

    function setPage($page){
        $this->page = $page;
    }

    function setPageSize($page_size){
        $this->page_size = $page_size;
    }

    function setVenueId($venue_id){
        $this->venue_id = $venue_id;
    }

    function setEventId($event_id){
        $this->event_id = $event_id;
    }

    function setSupplierId($supplier_id){
        $this->supplier_id = $supplier_id;
    }

    function setSportType($sport_type){
        $this->sport_type = $sport_type;
    }

    function setCountry($country){
        $this->country = $country;
    }

    function setVenueName($venue_name){
        $this->venue_name = $venue_name;
    }

    function setCategoryName($category_name){
        $this->category_name = $category_name;
    }

    function setOnSvg($on_svg){
        $this->on_svg = $on_svg;
    }

    function setCategoryId($category_id){
        $this->category_id = $category_id;
    }

    function setSlug($slug){
        $this->slug = $slug;
    }


    function __construct( ) {
        parent::__construct();
    }

    // get remote city list
    function getCategories($country='', $page=1, $perPage=100){

        $data = [];

        if(!empty($this->getPage())){
            $data['page'] = $this->getPage();
        }

        if(!empty($this->getPageSize())){
            $data['page_size'] = $this->getPageSize();
        }

        if(!empty($this->getVenueId())){
            $data['venue_id'] = $this->getVenueId();
        }

        if(!empty($this->getEventId())){
            $data['event_id'] = $this->getEventId();
        }

        if(!empty($this->getSupplierId())){
            $data['supplier_id'] = $this->getSupplierId();
        }

        if(!empty($this->getSportType())){
            $data['sport_type'] = $this->getSportType();
        }

        if(!empty($this->getCountry())){
            $data['country'] = $this->getCountry();
        }

        if(!empty($this->getVenueName())){
            $data['venue_name'] = $this->getVenueName();
        }

        if(!empty($this->getCategoryName())){
            $data['category_name'] = $this->getCategoryName();
        }

        if(!empty($this->getOnSvg())){
            $data['on_svg'] = $this->getOnSvg();
        }

        if(!empty($this->getCategoryId())){
            $data['category_id'] = $this->getCategoryId();
        }

        if(!empty($this->getSlug())){
            $data['slug'] = $this->getSlug();
        }

        $response=  $this->getRequest('/categories', $data);
        return $response;

    }

    function getCategoryById($categoryId){

        // $data = ['venue_id'=>$venueId];
        $response=  $this->getRequest('/categories/'.$categoryId);
        return $response;
    }

    function __destruct() {

    }

}