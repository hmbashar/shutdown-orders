<?php 
// Don't call the file directly
if ( !defined( 'ABSPATH' ) ) exit;


// taxonomy register
function ssol_taxonomy()  {
	register_taxonomy(
		'ssol-category',  //The name of the taxonomy. Name should be in slug form (must not contain capital letters or spaces).
		'shutorder',                  //post type name
		array(
			'hierarchical'          => true,
			'label'                         => 'States',  //Display name
			'query_var'             => true,
			'show_admin_column'             => true,
			'rewrite'                       => array(
				'slug'                  => 'ssol-cat', // This controls the base slug that will display before each term
				'with_front'    => true // Don't display the category base before
			)
		)
	);
}
add_action('init', 'ssol_taxonomy');