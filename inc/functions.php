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




//Page  Attribute
function ssol_tamplate_add_page_attribute_dropdown( $post_templates, $wp_theme, $post, $post_type ) {

    $post_templates['shutdown.php'] = __('Shutdown Order', 'ssol');

    return $post_templates;
}

add_filter( 'theme_page_templates', 'ssol_tamplate_add_page_attribute_dropdown', 10, 4 );


//Template chnage
function ssol_load_tamplate_from_plugin( $template ) {

    if(  get_page_template_slug() === 'shutdown.php' ) {
    
        if ( $theme_file = locate_template( array( 'shutdown.php' ) ) ) {
            $template = $theme_file;
        } else {
            $template = SSOL_PLUGIN_PATH . 'inc/template/shutdown.php';
        }
    }

    //  if( is_singular( 'shutdown' ) ) {
    //         $template = SSOL_PLUGIN_PATH .'inc/template/single-shutdown.php';
    //   }


    if($template == '') {
        throw new \Exception('No template found');
    }

    return $template;
}

add_filter( 'template_include', 'ssol_load_tamplate_from_plugin' );




// Ajax action function
function ssol_shutdown_submit_result() {

	

	require_once(SSOL_PLUGIN_PATH . '/inc/template/process.php');
	

	exit;
}

add_action('wp_ajax_ssol_shutdown_submit_result', 'ssol_shutdown_submit_result');
add_action('wp_ajax_nopriv_ssol_shutdown_submit_result', 'ssol_shutdown_submit_result');