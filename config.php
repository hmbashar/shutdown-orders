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
Text Domain: ssol
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
if (!defined('ABSPATH')) exit;


define('SSOL_VERSION', '1.0');
define('SSOL_PLUGIN_PATH', plugin_dir_path(__FILE__));
define('SSOL_PLUGIN_DIR', plugin_dir_url(__FILE__));


function ssol_load_plugin_textdomain()
{
  load_plugin_textdomain('ssol', false, SSOL_PLUGIN_PATH . 'languages/');
}
add_action('plugins_loaded', 'ssol_load_plugin_textdomain');



//Supreox Order List
function ssol_script_enqueues()
{
  $current_term_id = get_queried_object_id(); // Assuming you're on a taxonomy term archive page

  // Main Stylesheet
  wp_enqueue_style('ssol-stylesheet', SSOL_PLUGIN_DIR . 'assets/css/style.css', NULL, SSOL_VERSION);

  // Plugin Main Responsive
  wp_enqueue_style('ssol-responsive-style', SSOL_PLUGIN_DIR . 'assets/css/responsive.css', NULL, SSOL_VERSION);

  // custom script
  wp_enqueue_script('ssol-custom-js', SSOL_PLUGIN_DIR . 'assets/js/custom.js', array('jquery'), true);

  // localization for ajax action state to child 
    wp_localize_script('ssol-custom-js', 'custom_ajax_object', array(
      'ajax_url' => admin_url('admin-ajax.php'),
      'posts_per_page' => 1,
      'current_term_id' => $current_term_id, // Pass the current term ID
  ));


  // custom chart
  wp_enqueue_script('ssol-custom-chart', SSOL_PLUGIN_DIR . 'assets/js/plotly-2.24.1.min.js', array('jquery'), true);


  // Ajax action for query
  wp_enqueue_script('ssol-data-ajax', SSOL_PLUGIN_DIR . 'assets/js/ajax-data.js', array('jquery'), 1.0, true);

  // localization for ajax query
  wp_localize_script('ssol-data-ajax', 'ssol_option_data', array('ajaxurl'  => admin_url('admin-ajax.php')));

  // Ajax action for state to child county
  wp_enqueue_script('ssol-state-to-child', SSOL_PLUGIN_DIR . 'assets/js/state-to-child.js', array('jquery'), 1.0, true);


  // localization for ajax action state to child 
  wp_localize_script('ssol-state-to-child', 'ssol_state_to_child', array('ajaxurl'  => admin_url('admin-ajax.php')));
}

add_action('wp_enqueue_scripts', 'ssol_script_enqueues');



// custom post register
require_once(SSOL_PLUGIN_PATH . 'inc/custom-post.php');
// custom functions
require_once(SSOL_PLUGIN_PATH . 'inc/functions.php');
// custom taxonomy
require_once(SSOL_PLUGIN_PATH . 'inc/taxonomy.php');

// Action Hooks
require_once(SSOL_PLUGIN_PATH . 'inc/action-hooks.php');

// Filter Hooks
require_once(SSOL_PLUGIN_PATH . 'inc/filter-hooks.php');

// chart data
require_once(SSOL_PLUGIN_PATH . 'inc/chart-data.php');

// shortcode register for state list
require_once(SSOL_PLUGIN_PATH . 'inc/template/shortcode.php');
