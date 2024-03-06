<?php

class Country extends XS2Event_API {

    
    function __construct( ) {
        parent::__construct();
    }

    
     // get remote country list
     function fetchCountry($country='', $page=1, $perPage=100){

        if(!empty($country)){
            $data['country'] = $country;
        }
        $response=  $this->getRequest('/countries', []);
        // update countries in wp_option table
        update_option('tc_countries', $response);
        return $response;
    }


    function getCountry($countryCode){

        $countryList = get_option('tc_countries');
        $countryList = json_decode($countryList, true);
        
        $filteredCountry = array_filter($countryList, function($country) use ($countryCode) {
            return $country['code'] == $countryCode;
        });

        return $filteredCountry;
    }

    function __destruct() {

    }

}