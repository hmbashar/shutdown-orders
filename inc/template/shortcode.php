<?php
// don't call the file directly
if (!defined('ABSPATH')) exit;


// Register Shortcode for state list
function ssol_state_list_shortcode($attrs, $content = NULL)
{
    ob_start();
    extract(shortcode_atts(array(

        'taxonomy'      => 'ssol-category',

    ), $attrs));

    // Get the taxonomy's terms
    $terms = get_terms(
        array(
            'taxonomy'      => $taxonomy, // taxonomy register name
            'hide_empty'    => false, // get all taxonomy terms
            'parent'        => 0, //get only parent taxonomy
        )
    );
?>

    <ul class="ssol-state-list-view">
        <?php
        // Check if any term exists
        if (!empty($terms) && is_array($terms)) {
            // Run a loop and print them all
            foreach ($terms as $term) :
        ?>
                <li><a href="<?php echo get_term_link($term->slug, $taxonomy); ?>"><?php echo $term->name; ?></a></li>

        <?php
            endforeach;
        }
        ?>
    </ul>
<?php



    return ob_get_clean();
}
add_shortcode('ssol_state_list', 'ssol_state_list_shortcode');
