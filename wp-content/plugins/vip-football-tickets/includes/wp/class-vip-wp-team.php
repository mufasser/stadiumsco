<?php
if ( ! defined( 'ABSPATH' ) ) die("Nope, this shouldn't have happened.  fix it!");

// class wp-post get query to wordpress by custom post type
require_once PLUGIN_DIR_PATH.'includes/wp/class-vip-wp-base.php';

class VipWpTeam extends VipWpBase {
    
    // get all teams

    private $teamID=0;
    // private $metaQueryFilters = [];

    function __construct(){
        parent::__construct();
    }

    // setters
    function setTeamID($teamID){
        $this->teamID = $teamID;
    }

    // getters
    function getTeamID(){
        return $this->teamID;
    }

    function getTeams($limit=-1){
        $teamQueryArgs = [
            'posts_per_page' => $limit,
            'post_type' => 'xs2_team',
            'post_status' => 'publish',
            'orderby' => 'title',
            'order' => 'ASC',
        ];

        if($this->getMetaQueryFilters()){
            $teamQueryArgs['meta_query'] = $this->getMetaQueryFilters();
        }
        $teams = [];        
        $teamsList = get_posts($teamQueryArgs);

        if ( count($teamsList) > 0 ) {
            $i=0;
            foreach ($teamsList as $team) {
                $teams[$i] = $team;
                $i++;
            }
        }
        return $teams;
    }
    
    function isTeamExist($teamID){
        return $this->isPostExist($teamID, 'team_id',  'xs2_team');
    }

    function getAllTeamIDs(){
        $teams = $this->getTeams();
        foreach($teams as $team){
            $teamIDs[] = get_post_meta($team->ID, 'team_id', true);
        }
        return array_filter($teamIDs);
    }

    function __destruct() {

    }
}