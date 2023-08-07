<?php
// Don't call the file directly
if (!defined('ABSPATH'))
    exit;

// Custom Post type title placeholder change.
function ssol_posttype_title_text($title)
{
    $screen = get_current_screen();

    if ('shutorder' == $screen->post_type) {
        $title = 'Order Title';
    }

    return $title;
}

add_filter('enter_title_here', 'ssol_posttype_title_text');




//Page  Attribute
function ssol_tamplate_add_page_attribute_dropdown($post_templates, $wp_theme, $post, $post_type)
{

    $post_templates['shutdown.php'] = __('Shutdown Order', 'ssol');

    return $post_templates;
}

add_filter('theme_page_templates', 'ssol_tamplate_add_page_attribute_dropdown', 10, 4);


//Template chnage
function ssol_load_tamplate_from_plugin($template)
{

    if (get_page_template_slug() === 'shutdown.php') {

        if ($theme_file = locate_template(array('shutdown.php'))) {
            $template = $theme_file;
        } else {
            $template = SSOL_PLUGIN_PATH . 'inc/template/shutdown.php';
        }
    }

    //  if( is_singular( 'shutdown' ) ) {
    //         $template = SSOL_PLUGIN_PATH .'inc/template/single-shutdown.php';
    //   }


    if ($template == '') {
        throw new \Exception('No template found');
    }

    return $template;
}

add_filter('template_include', 'ssol_load_tamplate_from_plugin');




// Ajax action function
function ssol_shutdown_submit_result()
{

    // Verify the nonce
    if ( !isset($_POST['ssol_nonce']) || !wp_verify_nonce( $_POST['ssol_nonce'], 'ssol_nonce_action' ) ) {
        wp_die('Permission error');
    }else {
        require_once(SSOL_PLUGIN_PATH . '/inc/template/process.php');
    }

    


    exit;
}

add_action('wp_ajax_ssol_shutdown_submit_result', 'ssol_shutdown_submit_result');
add_action('wp_ajax_nopriv_ssol_shutdown_submit_result', 'ssol_shutdown_submit_result');



// Ajax action function for state to child
function ssol_shutdown_state_to_child()
{
?>

    <select name="ssol_tax_child_id" id="ssol-county">
        <?php
        // checked if the form is submitted and get the parent taxonomy id
        if (!empty($_POST['sssolStateId'])) {
            $parent_term_id = $_POST['sssolStateId']; // get parent taxonomy id from selected form
        } //else {
        //     $parent_term_id = $term->term_id; // get parent taxonomy id from selected form
        // }
        // Get only taxonomy's child terms   
        $term_id = $parent_term_id; // get parent taxonomy id from selected form
        $taxonomy_name = 'ssol-category'; // get taxonomy register name
        $termchildren = get_term_children($term_id, $taxonomy_name);
        foreach ($termchildren as $child) :
            $term = get_term_by('id', $child, $taxonomy_name);
        ?>
            <option value="<?php echo esc_html($term->slug); ?>"><?php echo esc_html($term->name); ?></option>
        <?php endforeach; ?>
    </select>

    <?php

    exit;
}

add_action('wp_ajax_ssol_shutdown_state_to_child', 'ssol_shutdown_state_to_child');
add_action('wp_ajax_nopriv_ssol_shutdown_state_to_child', 'ssol_shutdown_state_to_child');




// get terms post count
function ssol_get_terms_postcount($id, $taxonomyName, $includeParent = false)
{
    $cat = get_term($id, $taxonomyName);

    if (is_wp_error($cat) || empty($cat)) {
        return 0;
    }

    if ($includeParent == true) {
        $count = (int) $cat->count;  // If you want to include the parent terms posts
    } else {
        $count = 0; // Initialize the total count for child terms
    }

    $args = array(
        'child_of' => $id,
    );

    $child_terms = get_terms($taxonomyName, $args);

    foreach ($child_terms as $child_term) {
        // Exclude the parent term itself from the count
        if ($child_term->term_id !== $id) {
            $count += $child_term->count;
        }
    }

    return $count;
}

// Register the custom template for 'ssol-category' taxonomy
function custom_ssol_category_template($template) {
    if (is_tax('ssol-category')) {

        $template = SSOL_PLUGIN_PATH . 'inc/taxonomy-ssol-category.php';
    }
    return $template;
}
add_filter('template_include', 'custom_ssol_category_template');


// Change the query for 'ssol-category' taxonomy archive page
function custom_taxonomy_archive_query($query) {
    if (is_tax('ssol-category') && $query->is_main_query()) {
        $query->set('post_type', 'shutorder'); // Set the post type to 'post'
        $query->set('posts_per_page', 1); // Set the number of posts per page (change it as needed)
    }
}
add_action('pre_get_posts', 'custom_taxonomy_archive_query');
