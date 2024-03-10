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
    public $headers = [];

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
        // $tokenResponse = $this->getToken();
        // if(!$tokenResponse){
        //     $this->authRequest();
        // }
        $this->headers = array(
            'Content-Type: application/json',
            'Accept: application/json'
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
        $curl = curl_init();
        $curlOpt = array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => $this->getTokenHeader($this->getToken())
            );
            curl_setopt_array($curl, $curlOpt);
        $response = curl_exec($curl);
        // echo '<h3>Get Request CurlOPt: </h3><pre>';
        //     print_r($curlOpt); 
        // echo '</pre>';
        // echo '<h3>Get Request Response: </h3><pre>';
        //         print_r($response); 
        //     echo '</pre>';
        curl_close($curl);
        return $response;   

    }

    function setHeaders($headers){
        $this->headers = $headers;
    }

    function getHeaders(){
       return  $this->headers = array(
            'Content-Type: application/json',
            'Accept: application/json'
        );
    }

    function getTokenHeader($token){
        return [
            'Content-Type: application/json',
            'Accept: application/json',
            'Authorization: Bearer '.$token
        ];
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

        $curlOpt =  array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => $data,
            CURLOPT_HTTPHEADER => $this->getHeaders()
            );
        // print_r($curlOpt); exit;
        curl_setopt_array($curl,$curlOpt);

        $response = curl_exec($curl);
        $this->setToken($response);
        curl_close($curl);
        return $response;

    }

    function setToken($data){

    

        $response = json_decode($data, true);
        
        // echo '<pre>'; print_r($response); echo '</pre>';

        if($response['status'] == 'success'){
            $this->access_token = $response['access_token'];
            $this->refresh_token = $response['refresh_token'];
            $this->token_type = $response['token_type'];
            $this->expires_in = $response['expires_in'];
            // update api session details
            $tokenData = [
                'access_token' => $this->access_token,
                'refresh_token' => $this->refresh_token,
                'token_type' => $this->token_type,
                'expires_in' => time()+$this->expires_in
            ];
            update_option("tc_api_token", $tokenData);
            
            return true;
        }
        return false;
    }

    function getToken(){

        $this->authRequest();
        return $this->access_token;
        
        // $apiToken = get_option("tc_api_token");

        // if($apiToken){
        //     if($apiToken['expires_in'] > time()){
        //         $this->access_token = $apiToken['access_token'];
        //         $this->refresh_token = $apiToken['refresh_token'];
        //         $this->token_type = $apiToken['token_type'];
        //         $this->expires_in = $apiToken['expires_in'];
        //         return $this->access_token;
        //     }else{
        //         // refresh token
        //         $this->authRequest();
        //         return $this->getToken();
        //     }
        // }else{
        //     $this->authRequest();
        //     // die($apiToken.'mi die');
        //     return $this->getToken();
        // }
        // return false;
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
        CURLOPT_HTTPHEADER => $this->getTokenHeader($this->getToken())
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