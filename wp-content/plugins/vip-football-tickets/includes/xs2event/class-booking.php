<?php

class Booking extends XS2Event_API {

    private $page; // integer: current page (default: 1)
    private $page_size; // integer: number of items per page (default: 10)
    private string $reservation_id; //reservation_id
    private string $booking_id; // booking_id
    private bool $booking_code; // booking_code
    private string $booking_email;
    private string $distributor_id;
    private string $client_id;
    private string $compare_mode;
    private string $query;
    private string $mass_booking;
    private string $event_id;

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

    function setReservationId($reservation_id){
        $this->reservation_id = $reservation_id;
    }

    function setBookingId($booking_id){
        $this->booking_id = $booking_id;
    }

    function setBookingCode($booking_code){
        $this->booking_code = $booking_code;
    }

    function setBookingEmail($booking_email){
        $this->booking_email = $booking_email;
    }

    function setDistributorId($distributor_id){
        $this->distributor_id = $distributor_id;
    }

    function setClientId($client_id){
        $this->client_id = $client_id;
    }

    function setCompareMode($compare_mode){
        $this->compare_mode = $compare_mode;
    }

    function setQuery($query){
        $this->query = $query;
    }

    function setMassBooking($mass_booking){
        $this->mass_booking = $mass_booking;
    }

    function setEventId($event_id){
        $this->event_id = $event_id;
    }

    //getters

    function getPage(){
        return $this->page;
    }

    function getPageSize(){
        return $this->page_size;
    }

    function getReservationId(){
        return $this->reservation_id;
    }

    function getBookingId(){
        return $this->booking_id;
    }

    function getBookingCode(){
        return $this->booking_code;
    }

    function getBookingEmail(){
        return $this->booking_email;
    }

    function getDistributorId(){
        return $this->distributor_id;
    }

    function getClientId(){
        return $this->client_id;
    }

    function getCompareMode(){
        return $this->compare_mode;
    }

    function getQuery(){
        return $this->query;
    }

    function getMassBooking(){
        return $this->mass_booking;
    }

    function getEventId(){
        return $this->event_id;
    }

    function getBookings(){

        $data = [];
        if(!empty($this->page)){
            $data['page'] = $this->page;
        }
        if(!empty($this->page_size)){
            $data['page_size'] = $this->page_size;
        }

        if(!empty($this->reservation_id)){
            $data['reservation_id'] = $this->reservation_id;
        }

        if(!empty($this->booking_id)){
            $data['booking_id'] = $this->booking_id;
        }

        if(!empty($this->booking_code)){
            $data['booking_code'] = $this->booking_code;
        }

        if(!empty($this->booking_email)){
            $data['booking_email'] = $this->booking_email;
        }

        if(!empty($this->distributor_id)){
            $data['distributor_id'] = $this->distributor_id;
        }

        if(!empty($this->client_id)){
            $data['client_id'] = $this->client_id;
        }

        if(!empty($this->compare_mode)){
            $data['compare_mode'] = $this->compare_mode;
        }

        if(!empty($this->query)){
            $data['query'] = $this->query;
        }

        if(!empty($this->mass_booking)){
            $data['mass_booking'] = $this->mass_booking;
        }

        if(!empty($this->event_id)){
            $data['event_id'] = $this->event_id;
        }


        $response=  $this->getRequest('/sports', $data);
        return $response;
    }

    // get reservation by id
    function getBookingById($bookingId){
        $response=  $this->getRequest('/bookings/'.$bookingId);
        return $response;
    }

    // create reservation
    function createBooking($payload){

        $data = '{
            "order_type": "string",
            "notes": "string",
            "notify_client": true,
            "items": [
              {
                "ticket_id": "string",
                "quantity": 0,
                "net_rate": 0,
                "currency_code": "string"
              }
            ],
            "booking_email": "string"
          }';

        $response=  $this->postRequest('/bookings', $data);
        return $response;

    }

    // GET/bookings/reservation/{reservation_id}
    function getReservationById($reservationId){
        $response=  $this->getRequest('/bookings/reservation/'.$reservationId);
        return $response;
    }

    function __destruct() {

    }

    

}