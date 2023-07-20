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
     wp_enqueue_style( 'ssol-stylesheet', WP_PRO_PLUGIN_DIR.'assets/css/style.css', NULL, SSOL_VERSION);

     // Plugin Main Responsive
     wp_enqueue_style( 'ssol-responsive-style', WP_PRO_PLUGIN_DIR.'assets/css/responsive.css', NULL, SSOL_VERSION);
     
    // custom scripts
     wp_enqueue_script( 'ssol-custom', WP_PRO_PLUGIN_DIR.'assets/js/custom.js', array('jquery'), true );
 }
 
 add_action('wp_enqueue_scripts', 'ssol_script_enqueues');
 


// cusotom post register
require_once( SSOL_PLUGIN_PATH . 'inc/custom-post.php' );
// custom functions
require_once( SSOL_PLUGIN_PATH . 'inc/functions.php' );
// custom taxonomy
require_once( SSOL_PLUGIN_PATH . 'inc/taxonomy.php' );