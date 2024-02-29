<?php
require_once PLUGIN_DIR_PATH.'includes/class-xs2event-api.php'; 
class City extends XS2Event_API {


    function __construct( ) {
        parent::__construct();
    }


    // get remote city list
    function getCities($country='', $page=1, $perPage=100){
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