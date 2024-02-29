<?php
require_once PLUGIN_DIR_PATH.'includes/class-travel-connection-api.php'; 
class City extends Travel_Connection_API {


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