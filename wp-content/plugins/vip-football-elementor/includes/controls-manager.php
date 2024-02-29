<?php

class ControlTeam extends \Elementor\Controls_Manager {

    /**
     * Register the control
     *
     * @param \Elementor\Controls_Manager $controls_manager
     */
    public function register( $controls_manager ) {
        $controls_manager->register( new ControlTeam() );
    }
}