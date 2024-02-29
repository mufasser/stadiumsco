<?php

/**
 * 
 * Vip theme functions
 * 
 * 
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

function getVipEventsByTournament( $tournamentID ) {

    $tournament_id = get_field( 'tournament_id', $tournamentID );
    // echo "Tournament ID: "; print($tournament_id); 

    $args = [
        'post_status' => 'publish',
        'post_type' => 'xs2_event',
        'meta_key' => 'tournament_id',
        'meta_value' => $tournament_id,
        'posts_per_page' => -1
    ];

    return get_posts( $args );
}

function getVipEventMetadata($eventID) {
    // get all metadata
    $metadata = get_post_meta($eventID);
    return $metadata;
}


function getVipEventsByTeam( $teamID ) {

    $xs2_team_id = get_field( 'team_id', $teamID );
    // echo "Tournament ID: "; print($tournament_id); 

    $args = [
        'post_status' => 'publish',
        'post_type' => 'xs2_event',
        // 'meta_key' => 'team_id',
        // 'meta_value' => $xs2_team_id,
        'meta_query' => [
            'relation' => 'OR',
            [
                'key' => 'hometeam_id',
                'value' => $xs2_team_id

            ],
            [
                'key' => 'visiting_id',
                'value' => $xs2_team_id
            ]
            ],
        'posts_per_page' => -1
    ];

    // print_r($args);

    return get_posts( $args );
}

function getTickets(){
    
}

?>