<?php 
 // Don't call the file directly
if ( !defined( 'ABSPATH' ) ) exit;


// Shut
function state_and_county_required(){
	echo __('State and county is required', 'ssol');
}
add_filter( 'state_and_county_required', 'state_and_county_required');