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
 * @package    Vip_Football_Tickets
 * @subpackage Vip_Football_Tickets/includes
 * @author     Mufasser Islam <mufasseri@gmail.com>
 */
class XS2Event_API {

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

    // headers
    public $headers;

    
    public function __construct( ) {

        $this->baseUrl = "https://testapi.xs2event.com/v1";
        $this->api_key = "583e4d7146df4f90bd0c9d55ff27592f";
        $this->headers = array(
            'x-api-key:'.$this->api_key,
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