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



    require_once(SSOL_PLUGIN_PATH . '/inc/template/process.php');


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
function ssol_get_terms_postcount($id, $taxonomyName, $includeParent = false) {   
    $cat = get_term($id, $taxonomyName);
 
    if (is_wp_error($cat) || empty($cat)) {
        return 0;
    }
    
    if($includeParent == true) {
        $count = (int) $cat->count;  // If you want to include the parent terms posts
    }else {
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
 
 



function customscript()
{

    // Get the taxonomy's terms
    $terms = get_terms(
        array(
            'taxonomy'      => 'ssol-category', // taxonomy register name
            'hide_empty'    => false, // get all taxonomy terms
            'parent'        => 0, //get only parent taxonomy
        )
    );
    // Create an empty array to store the term names
    $term_slugs = array();   

    // Check if any term exists
    if (!empty($terms) && is_array($terms)) {
        // Run a loop and print them all
        foreach ($terms as $term) :            
            $term_slugs[] = strtoupper($term->slug); // set all term slug in array  
          echo  ssol_get_terms_postcount($term->term_id, 'ssol-category', false ).'<br>';

        endforeach;
    }

?>

    <script>
        var xValue = <?php echo json_encode($term_slugs); ?>;        
        var trace1 = {
            x: xValue,
            y: [20, 14, 23],
            name: 'State',
            type: 'bar',         
        };

        var trace2 = {
            x: xValue,
            y: [12, 18, 29],
            name: 'County',
            type: 'bar',
           
        };

        var trace3 = {
            x: xValue,
            y: [30, 40, 69],
            name: 'City',
            type: 'bar',
        };


        var data = [trace1, trace2, trace3];

        var layout = {
            barmode: 'stack',
            title: 'Shutdowns by State',
            bargap: 0.05,
            font: {
                family: 'Raleway, sans-serif'
            },
           // showlegend: false,
            xaxis: {
                tickangle: -45
            },
            yaxis: {
                zeroline: false,               
            },
        };

        Plotly.newPlot('myDiv', data, layout);
    </script>

<?php
}

add_action('wp_footer', 'customscript');
