<?php
// Don't call the file directly
if (!defined('ABSPATH')) exit;

// Shutdown options select message
function state_and_county_required()
{
	echo __('State and county is required', 'ssol');
}
add_filter('state_and_county_required', 'state_and_county_required');


// find your state heading
function ssol_find_your_state()
{
    echo __('<h2>Find your state</h2>', 'ssol');
    
}
add_filter('ssol_find_your_state', 'ssol_find_your_state');


// state label for form
function ssol_state_label()
{
    echo __('State', 'ssol');
}
add_filter('ssol_state_label', 'ssol_state_label');

// county label for form
function ssol_county_label()
{
    echo __('Find your county', 'ssol');
}
add_filter('ssol_county_label', 'ssol_county_label');


// state archive heading
function ssol_state_archive_heading()
{
    echo __(' State Orders', 'ssol');
}
add_filter('ssol_state_archive_heading', 'ssol_state_archive_heading');