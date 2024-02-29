<?php

class Country extends XS2Event_API {

    
    function __construct( ) {
        parent::__construct();
    }

    
     // get remote country list
     function getCountry($country='', $page=1, $perPage=100){
        $data = ['page'=>$page, "page_size"=> $perPage];

        if(!empty($country)){
            $data['country'] = $country;
        }
        $response=  $this->getRequest('/cities', $data);
        return $response;
    }

    function __destruct() {

    }

}