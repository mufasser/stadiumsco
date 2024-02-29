<?php
if ( ! defined( 'ABSPATH' ) ) die("Nope, this shouldn't have happened.  fix it!");

// class wp-post get query to wordpress by custom post type
require_once PLUGIN_DIR_PATH.'utils/class-utils.php';
class VipWpBase  {
    
    var $metaQueryFilters = [];

    var $utils;

    function __construct(){

        $this->utils = new Utils();
    }

    // setters

    function addMetaQueryFilter($metaQuery){
        $this->metaQueryFilters[] = $metaQuery;
    }

    function resetMetaQueryFilters(){
        $this->metaQueryFilters = [];
    }

    // getters


    function getMetaQueryFilters(){
        return $this->metaQueryFilters;
    }

    function savePost($data){

    }
    function savePostMeta($data, $postId){

    }
    
    function isPostExist($postID,$key, $postType){

        // print_r($data); exit;
        $teamQueryArgs = [
            'post_type' => $postType,
            'posts_per_page' => 1,
            'meta_query' => [[
                'key' => $key,
                'value' => $postID,
                'compare' => '='
                ]],
            ];

        $query = new WP_Query($teamQueryArgs);
        if($query->found_posts > 0) {
            while($query->have_posts()) : $query->the_post();
                return get_the_ID();
            endwhile;
            // return true;
        }
        return false;
    }

    function __destruct() {

    }
}