<?php
if ( ! defined( 'ABSPATH' ) ) die("Nope, this shouldn't have happened.  fix it!");


class VipAjax {

    function __construct(){

        // add_action( 'wp_footer', array( $this, 'aux_function' ) );
        add_action( 'wp_enqueue_scripts', array( $this, 'inItVipAjax' ) );

        add_action( 'wp_ajax_vip_get_tickets', array( $this, 'vip_get_tickets' ) ); 
        add_action( 'wp_ajax_nopriv_vip_get_tickets', array( $this, 'vip_get_tickets' ) );
    }
    function inItVipAjax(){
        wp_enqueue_script( 'vip_ajax_script',  plugins_url( 'public/js/vip-ajax.js',__FILE__ ), array('jquery'), TRUE );
        wp_localize_script( 
            'vip_ajax_script', 
            'vipAjaxGetTickets', 
            array(
                'url'   => admin_url( 'admin-ajax.php' ),
                'nonce' => wp_create_nonce( "vip_get_tickets_nonce" ),
            )
        );    
    }

    public function vip_get_tickets()
    {

        // load VIP classes and functions
        

        check_ajax_referer( 'vip_get_tickets_nonce', 'nonce' );
        $custom_error = [];
        if( true )
            wp_send_json_success( 'Ajax here!' );
        else
            wp_send_json_error( array( 'error' => $custom_error ) );
    }


}
