<?php

if( ! defined( 'ABSPATH' ) ) {
    exit;
}

class VipTemplates {
 
    function __construct(){
        // add filter  on theme_page_templates
        $this->addFilter('page_template', $this, 'vip_tournaments_page_template' );
    }

    // add filter function
    function addFilter($hook, $component, $callback, $priority = 10, $accepted_args = 1) {
        add_filter( $hook, array($component, $callback), $priority, $accepted_args );
    }

    // remove filter function
    function removeFilter($hook, $component, $callback) {
        remove_filter( $hook, array($component, $callback) );
    }

    // add action function
    function addAction($hook, $component, $callback, $priority = 10, $accepted_args = 1) {
        add_action( $hook, array($component, $callback), $priority, $accepted_args );
    }

    // remove action function
    function removeAction($hook, $component, $callback) {
        remove_action( $hook, array($component, $callback) );
    }

    // tournament page template

    function vip_tournaments_page_template($templates) {

        $templates[plugin_dir_path(__FILE__) . 'templates/vip-tournaments-page-template.php'] = __( 'VIP Tournaments Page', 'vip-football-tickets' );
        return $templates;
    }
    
}