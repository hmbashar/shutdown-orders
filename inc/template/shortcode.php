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



// Register Shortcode for chart list
function ssol_chart_shortcode($attrs, $content = NULL)
{
    ob_start();
    extract(shortcode_atts(array(

        'taxonomy'      => 'ssol-category',

    ), $attrs));

    
?>
  <!--Chart Area-->
  <div id='ssol_chart_data'></div><!--Chart Area-->

<?php 
    ssol_bar_chart_data('ssol_chart_data');
    return ob_get_clean();
}
add_shortcode('ssol_chart_data', 'ssol_chart_shortcode');


// register shortcode for ajax show all data this function is in inc/action-hooks.php
add_shortcode('ssol_ajax_show_all_data', 'ssol_ajax_show_all_data');


// register shortcode for chart color identify
function ssol_chart_color_identify() {
    ?>
            <div class="ssol-sate-color-identify">
                <!--Single Color-->
                <div class="ssol-single-color">
                    <div class="ssol-single-color-box ssol-box-state"></div>
                    <p>State</p>
                </div><!--Single Color-->
                <!--Single Color-->
                <div class="ssol-single-color">
                    <div class="ssol-single-color-box ssol-box-conuty"></div>
                    <p>County</p>
                </div><!--Single Color-->
            </div>

<?php
}

add_shortcode('ssol-chart-color-identify', 'ssol_chart_color_identify');