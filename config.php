<?php
/**
 * @package Shutdown Orders list
 */
/*
Plugin Name: Shutdown Orders List
Plugin URI: https://github.com/hmbashar/shutdown-orders
Description: This Plugin for showing State and Local Government COVID-19 Shutdown Orders list (https://ercspecialists.com/shutdown-orders)
Version: 1.0
Author: Md Abul Bashar
Author URI: https://www.supreox.com
License: GPLv2 or later
*/

/*
This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.
*/
/*
*   
*/
// Don't call the file directly
if ( !defined( 'ABSPATH' ) ) exit;


define( 'SSOL_VERSION', '1.0' );
define( 'SSOL_PLUGIN_PATH', plugin_dir_path( __FILE__ ) );
define( 'SSOL_PLUGIN_DIR', plugin_dir_url( __FILE__ ));


//Supreox Order List
function ssol_script_enqueues() {      
           
 
     // Main Stylesheet
     wp_enqueue_style( 'ssol-stylesheet', SSOL_PLUGIN_DIR.'assets/css/style.css', NULL, SSOL_VERSION);

     // Plugin Main Responsive
     wp_enqueue_style( 'ssol-responsive-style', SSOL_PLUGIN_DIR.'assets/css/responsive.css', NULL, SSOL_VERSION);
     
    // custom scripts
     wp_enqueue_script( 'ssol-custom', SSOL_PLUGIN_DIR.'assets/js/custom.js', array('jquery'), true );


    // Ajax action for query
     wp_enqueue_script( 'ssol-data-ajax', SSOL_PLUGIN_DIR .'assets/js/ajax-data.js', array('jquery'), 1.0, true );

    // Ajax action for state to child county
     wp_enqueue_script( 'ssol-state-to-child', SSOL_PLUGIN_DIR .'assets/js/state-child.js', array('jquery'), 1.0, true );

     // localization for ajax query
     wp_localize_script( 'ssol-data-ajax', 'ssol_option_data', array( 'ajaxurl'	=> admin_url('admin-ajax.php')) ); 

     // localization for ajax action state to child
     wp_localize_script( 'ssol-state-to-child', 'ssol_state_to_child', array( 'ajaxurl'	=> admin_url('admin-ajax.php')) ); 
 }
 
 add_action('wp_enqueue_scripts', 'ssol_script_enqueues');
 


// custom post register
require_once( SSOL_PLUGIN_PATH . 'inc/custom-post.php' );
// custom functions
require_once( SSOL_PLUGIN_PATH . 'inc/functions.php' );
// custom taxonomy
require_once( SSOL_PLUGIN_PATH . 'inc/taxonomy.php' );
// Hooks
require_once( SSOL_PLUGIN_PATH . 'inc/hooks.php' );