<?php
if ( ! defined( 'ABSPATH' ) ) die("Nope, this shouldn't have happened.  fix it!");

// class wp-post get query to wordpress by custom post type
require_once PLUGIN_DIR_PATH.'includes/wp/class-vip-wp-base.php';

class VipWpTournament extends VipWpBase {
    
    // get all tournaments

    private $tournamentID=0;
    // private $metaQueryFilters = [];

    function __construct(){
        parent::__construct();
    }

    // setters
    function setTournamentID($tournamentID){
        $this->tournamentID = $tournamentID;
    }

    // getters
    function getTournamentID(){
        return $this->tournamentID;
    }

    function getTournaments($limit=-1){

        $tournamentQueryArgs = [
            'posts_per_page' => $limit,
            'post_type' => 'tournament',
            'post_status' => 'publish',
            'orderby' => 'title',
            'order' => 'ASC',
            'meta_query' => $this->getMetaQueryFilters()
        ];

        if($this->getTournamentID() > 0){
            $tournamentQueryArgs['ID'] = $this->getTournamentID();
        }

        // $this->utils->printFormateArray($tournamentQueryArgs);
        $tournaments = [];        
        $tournamentsList = get_posts($tournamentQueryArgs);

        if ( count($tournamentsList) > 0 ) {
            $i=0;
            foreach ($tournamentsList as $tournament) {
                $tournaments[$i] = $tournament;
                $i++;
            }
        }
        return $tournaments;
    }
    
    function isTournamentExist($tournamentID, $checkBy="tournament_id"){

        return $this->isPostExist($tournamentID, $checkBy, 'tournament');
    }

    function checkSameNameTournament($tournamentName){

        $tournaments = $this->getTournaments();
        foreach($tournaments as $tournament){
            if($tournament->post_title == $tournamentName){
                return true;
            }
        }
        return false;
    }

    function getTournamentMetadata($tournamentID, $metaKey=''){
        if(!empty($metaKey)){
            //echo "$metaKey, $tournamentID";
            return get_field( $metaKey, $tournamentID, true);
        }
        // echo "$metaKey, $tournamentID";
        return; // get_fields($tournamentID);
    }
    
    function __destruct() {

    }
}