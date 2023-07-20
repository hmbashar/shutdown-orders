<?php 
// Don't call the file directly
if ( !defined( 'ABSPATH' ) ) exit;

// Custom Post type title placeholder change.
function ssol_posttype_title_text( $title ){
    $screen = get_current_screen();
 
    if  ( 'shutorder' == $screen->post_type ) {
         $title = 'Order Title';
    }   
 
    return $title;
}
 
add_filter( 'enter_title_here', 'ssol_posttype_title_text' );