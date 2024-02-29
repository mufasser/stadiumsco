<?php

class Reservation extends XS2Event_API {

    private $page_size = 20; // integer: number of items per page (default: 10)
    private $page = 1; // integer: current page (default: 1)
    private string $created = ""; //Filter reservation on their creation date
    private string $valid_until = "";// Filter reservation on their valid until date
    private string $status = ""; //Filter reservation on their status active, booked, void, error, extended Available values : active, booked, void, error, extended
    private string $query = "";// Filter reservation on their query
    private string $event_id = "";// Filter reservation on their event

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

    function setCreated($created){
        $this->created = $created;
    }

    function setValidUntil($valid_until){
        $this->valid_until = $valid_until;
    }

    function setStatus($status){
        $this->status = $status;
    }

    function setQuery($query){
        $this->query = $query;
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

    function getCreated(){
        return $this->created;
    }

    function getValidUntil(){
        return $this->valid_until;
    }

    function getStatus(){
        return $this->status;
    }

    function getQuery(){
        return $this->query;
    }

    function getEventId(){
        return $this->event_id;
    }


    function getReservations(){

        $data = [];
        if(!empty($this->page)){
            $data['page'] = $this->page;
        }
        if(!empty($this->page_size)){
            $data['page_size'] = $this->page_size;
        }

        if(!empty($this->created)){
            $data['created'] = $this->created;
        }

        if(!empty($this->valid_until)){
            $data['valid_until'] = $this->valid_until;
        }

        if(!empty($this->status)){
            $data['status'] = $this->status;
        }

        if(!empty($this->query)){
            $data['query'] = $this->query;
        }

        if(!empty($this->event_id)){
            $data['event_id'] = $this->event_id;
        }

        $response=  $this->getRequest('/sports', $data);
        return $response;
    }

    // get reservation by id
    function getReservationById($reservationId){
        $response=  $this->getRequest('/reservations/'.$reservationId);
        return $response;
    }

    // create reservation
    function createReservation($payload){

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

        $response=  $this->postRequest('/reservations', $data);
        return $response;

    }

    // delete reservation
    function deleteReservation($reservationId){

        $response=  $this->deleteRequest('/reservations/'.$reservationId, []);
        return $response;

    }
    // update reservation
    function updateReservation($reservationId){
        $payload = '  "items": [
            {
              "ticket_id": "string",
              "quantity": 0,
              "net_rate": 0,
              "currency_code": "string"
            }
          ],
          "payment_method": "invoice"
        }';
        $response=  $this->putRequest('/reservations/'.$reservationId, $payload);
        return $response;
        
    }

    // GET /reservations/{reservation_id}/guest/details
    function getReservationGuestDetails($reservationId){
        $response=  $this->getRequest('/reservations/'.$reservationId.'/guest/details');
        return $response;
    }

    // POST/reservations/{reservation_id}/guestdata
    function postReservationGuestData($reservationId, $payload){
        $response=  $this->postRequest('/reservations/'.$reservationId.'/guestdata', $payload);
        return $response;
    }

    //GET/reservations/{reservation_id}/guestdata
    function getReservationGuestData($reservationId){
        $response=  $this->getRequest('/reservations/'.$reservationId.'/guestdata');
        return $response;
    }

    //GET/reservations/{reservation_id}/guestdata/{guest_id}
    function getReservationGuestDataById($reservationId, $guestId){
        $response=  $this->getRequest('/reservations/'.$reservationId.'/guestdata/'.$guestId);
        return $response;
    }

    //PUT/reservations/{reservation_id}/guestdata/{guest_id}
    function putReservationGuestDataById($reservationId, $guestId, $payload){
        $response=  $this->putRequest('/reservations/'.$reservationId.'/guestdata/'.$guestId, $payload);
        return $response;
    }

    //POST/reservations/{reservation_id}/guests
    function postReservationGuests($reservationId, $payload){
        $response=  $this->postRequest('/reservations/'.$reservationId.'/guests', $payload);
        return $response;
    }

    function __destruct() {

    }

}