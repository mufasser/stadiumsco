<?php
	require_once PLUGIN_DIR_PATH.'includes/class-travel-connection-api.php'; 

class Tc_Country extends Travel_Connection_API {

    
    function __construct( ) {
        parent::__construct();
    }
    
     // get remote country list
     function fetchCountry($country='', $page=1, $perPage=100){

        if(!empty($country)){
            $data['country'] = $country;
        }
        $response =  $this->getRequest('countries', []);
        $response = json_decode($response, true);
        
        // update countries in wp_option table
        update_option('tc_countries', json_encode($response['data']));
        return $response;
    }

    function getCountry($countryCode='gb'){

        $countryList = get_option('tc_countries');
        $countryList = json_decode($countryList, true);
        // print_r($countryList);
        if($countryCode != ''){
            $filteredCountry = array_filter($countryList, function($country) use ($countryCode) {
                // echo ($country['code'] == $countryCode);
                return $country['code'] == $countryCode;
            });
            return $filteredCountry[0]?$filteredCountry[0]:[];
        }else{
            return $countryList;
        }
    }

    function __destruct() {

    }

}