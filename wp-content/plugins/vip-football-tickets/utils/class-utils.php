<?php

class Utils {

    function __construct( ) {
    }

    // get days 
    function getTwoDatesFromPeriods($addDays, $subDays){
        
        $date = new DateTime('now'); // Y-m-d
		
		$currentDate = $date->sub(new DateInterval('P'.$subDays.'D')); // subtract 30 days
		$lastDate = $currentDate->format('Y-m-d');
		
		$date = new DateTime('now'); // Y-m-d
		$futureDate = $date->add(new DateInterval('P'.$addDays.'D')); // plus 30 days
		$nextDate = $futureDate->format('Y-m-d');

        return [
            'last30date' => $lastDate,
            'next30date' => $nextDate
        ];
    }


    function printFormateArray($array, $die=false){
        echo '<pre>';
        print_r($array);
        echo '</pre>';
        if($die){
            die();
        }
    }
}

?>