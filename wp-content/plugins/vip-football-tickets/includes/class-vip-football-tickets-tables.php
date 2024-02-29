<?php
if ( ! defined( 'ABSPATH' ) ) die("Nope, this shouldn't have happened.  fix it!");
class Vip_Football_Tickets_Tables {


    //add_filter( 'manage_tournament_posts_columns', 'set_custom_edit_tournament_columns' );
    function set_custom_edit_tournament_columns($columns) {
        //unset( $columns['author'] );
      $columns['tournament_tournament_id'] = __( 'Tournament ID', 'vip-football-tickets' );
      $columns['tournament_date_start'] = __( 'Date Start', 'vip-football-tickets' );
      $columns['tournament_date_stop'] = __( 'Date Stop', 'vip-football-tickets' );
      return $columns;
    }

   //add_action( 'manage_tournament_posts_custom_column' , 'custom_tournament_column', 10, 2 );
    function custom_tournament_column( $column, $post_id ) {

      switch ( $column ) {

        case 'tournament_tournament_id' :
        echo get_field( 'tournament_id', $post_id , true ); 
        break;

        case 'tournament_date_start' :
        echo get_field( 'date_start', $post_id , true ); 
        break;

        case 'tournament_date_stop' :
        echo get_field( 'date_stop', $post_id , true ); 
        break;

      }
    }


    // add custom columns on team CRUD table
    function set_custom_edit_xs2_team_columns($columns) {
      //unset( $columns['author'] );
    $columns['xs2_team_team_id'] = __( 'Team ID', 'vip-football-tickets' );
    $columns['xs2_team_sport_type'] = __( 'Sport Type', 'vip-football-tickets' );
    // $columns['xs2_team_date_stop'] = __( 'Date Stop', 'vip-football-tickets' );
    return $columns;
  }

 //add_action( 'manage_xs2_team_posts_custom_column' , 'custom_xs2_team_column', 10, 2 );
  function custom_xs2_team_column( $column, $post_id ) {

    switch ( $column ) {

      case 'xs2_team_team_id' :
      echo get_field( 'team_id', $post_id , true ); 
      break;

      case 'xs2_team_sport_type' :

      echo get_field( 'sport_type', $post_id , true ); 
      break;

      // case 'xs2_team_date_stop' :

      // echo get_field( 'date_stop', $post_id , true ); 
      // break;

    }
  }

  // add custom columns on event CRUD table
  function set_custom_edit_xs2_event_columns($columns) {
    //unset( $columns['author'] );
    $columns['xs2_event_event_id'] = __( 'Event ID', 'vip-football-tickets' );
    $columns['xs2_event_event_status'] = __( 'Event Status', 'vip-football-tickets' );
    $columns['xs2_event_date_start_date_end'] = __( 'Date Start / Date Stop', 'vip-football-tickets' );
    $columns['xs2_event_tournament_name'] = __( 'Tournament Name', 'vip-football-tickets' );
    return $columns;
  }

  //add_action( 'manage_xs2_event_posts_custom_column' , 'custom_xs2_event_column', 10, 2 );
  function custom_xs2_event_column( $column, $post_id ) {

    switch ( $column ) {

      case 'xs2_event_event_id' :
        echo get_field( 'event_id', $post_id , true ); 
      break;
      case 'xs2_event_event_status' :
        echo get_field( 'event_status', $post_id , true ); 
      break;
      case 'xs2_event_date_start_date_end' :
        echo date( 'd M, Y', strtotime(get_field( 'date_start', $post_id , true )) ); 
        echo ' / '; 
        echo date( 'd M, Y', strtotime(get_field( 'date_stop', $post_id , true )) ); 
        
        //echo get_field( 'date_start', $post_id , true ); 
        // echo ' / ';
        // echo get_field( 'date_stop', $post_id , true );
      break;
      case 'xs2_event_tournament_name' :
        echo get_field( 'tournament_name', $post_id , true ); 
      break;
    }
  }

  function  event_parse_filter($query) {
    global $pagenow;
    $current_page = isset( $_GET['post_type'] ) ? $_GET['post_type'] : '';
    
    if ( is_admin() && 
      'xs2_event' == $current_page &&
      'edit.php' == $pagenow && 
      isset( $_GET['date-start'] ) && 
      $_GET['date_start'] != '' ) {
    
    $date_start = $_GET['date_start'];
    $query->query_vars['meta_key']  = 'date_start';
    $query->query_vars['meta_value']  = $date_start;
    $query->query_vars['meta_compare']  = '=';
  }
  }

}

