<?php 

// Don't call the file directly
if ( !defined( 'ABSPATH' ) ) exit;



/* Register Custom Post Types********************************************/
function ssol_create_post_type() {
        // Register post type for Professional
        register_post_type( 'shutorder',
                array(
                        'labels' => array(
                                'name' => __( 'Shutdown Order', 'ssol' ),
                                'singular_name' => __( 'Shutdown Order', 'ssol' ),
                                'add_new' => __( 'Add New', 'ssol' ),
                                'add_new_item' => __( 'Add New', 'ssol' ),
                                'edit_item' => __( 'Edit Shutdown Order', 'ssol' ),
                                'new_item' => __( 'New Shutdown Order', 'ssol' ),
                                'view_item' => __( 'View Shutdown Order', 'ssol' ),
                                'not_found' => __( 'Sorry, we couldn\'t find the shutdown you are looking for.', 'ssol' ),
                                'set_featured_image'    => __('Set Cover Image', 'ssol'),
                                // Overrides the “Remove featured image” label
                                'remove_featured_image' => _x( 'Remove cover image', 'ssol' ),
                                // Overrides the “Use as featured image” label
                                'use_featured_image'    => _x( 'Use as cover image', 'ssol' ),
                        ),
                'public' => true,
                'publicly_queryable' => true,
                'exclude_from_search' => true,
                'menu_icon'   => 'dashicons-lock',
                'has_archive' => false,
                'hierarchical' => false,
                'capability_type' => 'page',
                'rewrite' => array( 'slug' => 'ssol-shutdown' ),
                'supports' => array( 'title', 'excerpt' )
                )
        );      

}
add_action( 'init', 'ssol_create_post_type' );