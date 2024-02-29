<?php

require_once __DIR__ . '/inc/theme_functions.php';

function getTeamByTeamId(string $teamId){


  require_once PLUGIN_DIR_PATH.'/includes/wp/class-vip-wp-team.php';
  $wpVipTeam = new VipWpTeam();
  $metaQuery = [
    ['key' => 'team_id', 'value' => $teamId]
  ];
  $wpVipTeam->addMetaQueryFilter($metaQuery);
  $teams = $wpVipTeam->getTeams();
  $teamData = [
    'name' => $teams[0]->post_title,
    'id' => $teams[0]->ID,
    'team_id' => $teamId,
    'logo' => get_the_post_thumbnail_url( $teams[0]->ID, '128-small-square')
  ];
  // die(json_encode($teams));
  return $teamData;

}

function getDecoratedPrice(int $price, string $currency='&euro;'){
  if($price == 0){
    return 'Free';
  }
  $dividedPrice = $price/100;
  $formatePrice = number_format($dividedPrice, 2);
  return  $currency.$formatePrice;
}

function formatDateTime($dateTime){

  $cleanDate = str_replace('T',' ', $dateTime);
  $newDateTime = new DateTime($cleanDate);
  $date = $newDateTime->format('D d M');
  $time = $newDateTime->format('H:i');

  return [
    'date' => $date,
    'time' => $time
  ];

}

// get tournament_id from meta by wp tournamentID 
function getTournamentApiId($tournamentID){

  require_once PLUGIN_DIR_PATH.'/includes/wp/class-vip-wp-tournament.php';
  $wpVipTournament = new VipWpTournament();
  $tournament_id = $wpVipTournament->getTournamentMetadata($tournamentID, 'tournament_id');
  return $tournament_id;

}

function getCurrentPostId(){
  $url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
  $postId = url_to_postid($url);
  return $postId;
}

function getThumbnailByPostId($postId){
  if (has_post_thumbnail( $postId ) ):
    $imageSrc = wp_get_attachment_image_src( get_post_thumbnail_id( $postId ), 'medium' );
    return $imageSrc[0];
  endif;
  return [];
}

function getTournament($tournament_id){
}
