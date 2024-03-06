<?php
if ( ! defined( 'ABSPATH' ) ) die("Nope, this shouldn't have happened.  fix it!");
/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https://mufasseirislam.com
 * @since      1.0.0
 *
 * @package    Vip_Football_Tickets
 * @subpackage Vip_Football_Tickets/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Travel_Connection_API
 * @subpackage Travel_Connection_API/includes
 * @author     Mufasser Islam <mufasseri@gmail.com>
 */
class Travel_Connection_API {

    /**
     * The ID of this plugin.
     *
     * @since    1.0.0
     * @access   private
     * @var      bool    $baseUrl    The baseUrl of Xs2Event API.
     */
    public $baseUrl;

    // api key
    public $api_key;

    // username
    public $username;
    // password
    public $password;
    // grant_type
    public $grant_type;

    // access_token
    public $access_token;

    // refresh_token
    public $token_type;

    // refresh_token
    public $refresh_token;

    // expires_in
    public $expires_in;

    // headers
    public $headers;

    /*
    {
    "grant_type":"password",
    "username":"supplier@prestige-vip.com",
    "password":"_576osMZ9@"
}*/
    
    public function __construct( ) {

        $this->baseUrl = "https://api-sandbox.travelconnectionleisure.com/v1/";
        $this->username = "supplier@prestige-vip.com";
        $this->password = "_576osMZ9@";
        $this->grant_type = "password";
        // $this->api_key = "583e4d7146df4f90bd0c9d55ff27592f";
        $tokenResponse = $this->getToken();
        if(!$tokenResponse){
            $this->authRequest();
        }
        $this->headers = array(
            'accept:application/json'
        );

    }
    
    function prepareRemoteResponse($response){

        if(is_wp_error($response)){
            return $response;
        }
        return $response;
    }

    function getRequest($endPoint, $params = []) {

        $params = http_build_query($params);
        $url = $this->baseUrl.$endPoint.'?'.$params;
        // die($url);
        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'GET',
        CURLOPT_HTTPHEADER => [
            'x-api-key:'.$this->api_key,
            'accept:application/json'
            ]
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        return $response;

    }

    // Auth request
    function authRequest($endPoint='oauthorize/token', $data=[], $params = []) {

        $url = $this->baseUrl.$endPoint;
        if($params){
            $params = http_build_query($params);
            $url = $url.'?'.$params;
        }

        $data = json_encode([
            'grant_type' => $this->grant_type,
            'username' => $this->username,
            'password'=> $this->password
        ]);

        // die($url);
        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => $data,
        CURLOPT_HTTPHEADER => []
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        $this->setToken($response);
        return $response;

    }

    function setToken($data){

    /*
    {
    "status": "success",
    "access_token": "2f6c13aaf48d77cb20c3b75bdf9b860f9e0063f64d2853108725311451aa43b0",
    "refresh_token": "21ce887f704c70ca43c0f1eab0adfeee587afb76c7c7a71d0636cab0ac2dcacf",
    "token_type": "bearer",
    "expires_in": 3600
}
    */
        $response = json_decode($data, true);
        if($response['status'] == 'success'){
            $this->access_token = $response['access_token'];
            $this->refresh_token = $response['refresh_token'];
            $this->token_type = $response['token_type'];
            $this->expires_in = $response['expires_in'];
            // update api session details
            update_option("tc_api_token", [
                'access_token' => $this->access_token,
                'refresh_token' => $this->refresh_token,
                'token_type' => $this->token_type,
                'expires_in' => time()+$this->expires_in
            ]);
            
            return true;
        }
        return false;
    }

    function getToken(){
        
        $apiToken = get_option("tc_api_token");
        if($apiToken){
            if($apiToken['expires_in'] > time()){
                $this->access_token = $apiToken['access_token'];
                $this->refresh_token = $apiToken['refresh_token'];
                $this->token_type = $apiToken['token_type'];
                $this->expires_in = $apiToken['expires_in'];
                return true;
            }else{
                // refresh token
                $this->authRequest();
                return $this->getToken();
            }
        }else{
            $this->authRequest();
            return $this->getToken();
        }
        return false;
    }

    // post request
    function postRequest($endPoint, $data, $params = []) {

        $url = $this->baseUrl.$endPoint;
        if($params){
            $params = http_build_query($params);
            $url = $url.'?'.$params;
        }

        // die($url);
        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => $data,
        CURLOPT_HTTPHEADER => [
            'x-api-key:'.$this->api_key,
            'accept:application/json',
            'Content-Type:application/json'
            ]
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        return $response;

    }

    // delete request
    function deleteRequest($endPoint, $data, $params = []) {

        $url = $this->baseUrl.$endPoint;
        if($params){
            $params = http_build_query($params);
            $url = $url.'?'.$params;
        }

        // die($url);
        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'DELETE',
        CURLOPT_POSTFIELDS => $data,
        CURLOPT_HTTPHEADER => [
            'x-api-key:'.$this->api_key,
            'accept:application/json',
            'Content-Type:application/json'
            ]
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        return $response;

    }
    // delete request
    function putRequest($endPoint, $data, $params = []) {

        $url = $this->baseUrl.$endPoint;
        if($params){
            $params = http_build_query($params);
            $url = $url.'?'.$params;
        }

        // die($url);
        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'PUT',
        CURLOPT_POSTFIELDS => $data,
        CURLOPT_HTTPHEADER => [
            'x-api-key:'.$this->api_key,
            'accept:application/json',
            'Content-Type:application/json'
            ]
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        return $response;

    }


}