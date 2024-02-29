<?php

class Sport extends XS2Event_API {

    private $page_size = 20; // integer: number of items per page (default: 10)
    private $page = 1; // integer: current page (default: 1)
    
    function __construct( ) {
        parent::__construct();
    }

    //setter

    function setPage($page){
        $this->page = $page;
    }

    function setPageSize($pageSize){
        $this->page_size = $pageSize;
    }

    //getters

    function getPage(){
        return $this->page;
    }

    function getPageSize(){
        return $this->page_size;
    }

    function getSports(){

        $data = [];
        if(!empty($this->page)){
            $data['page'] = $this->page;
        }
        if(!empty($this->page_size)){
            $data['page_size'] = $this->page_size;
        }
        $response=  $this->getRequest('/sports', $data);
        return $response;
    }


    function __destruct() {

    }

}