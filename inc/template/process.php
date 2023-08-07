<?php
// Don't call the file directly
if (!defined('ABSPATH'))
    exit;
// Get the current page number
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;


// set variable for getting value from input field
$get_ssol_state = sanitize_text_field($_POST['SSOL_State']);
$get_ssol_county = sanitize_text_field($_POST['SSOL_County']);


if (empty($get_ssol_state) || empty($get_ssol_county)) { // search field empty check
    apply_filters('state_and_county_required', 'State and county is required');
} else {
?>
    <div class="ssol-state-order-list-area">
        <div class="ssol-state-order-list">
            <?php
            $selected_terms = get_term_by('slug', $get_ssol_county, 'ssol-category');   // get selected taxonomy term by slug                   
            ?>
            <h2 class="ssol-shutdown-order-heading"><?php echo esc_html($selected_terms->name); ?> County Orders</h2>

            <?php

            // get table header
            do_action('ssol_data_table_header');

            // checked if the form is submitted and get the child taxonomy id
            if (!empty($get_ssol_county)) {
                $child_term_id = $get_ssol_county;
            }
            // search/shorting query                
            $ShutdownSearch = new WP_Query(
                array(
                    'post_type' => 'shutorder',
                    'posts_per_page' => -1,
                    'paged' => $paged,
                    'tax_query' => array(
                        array(
                            'taxonomy' => 'ssol-category',
                            // taxonomy name
                            'field' => 'slug',
                            // term slug
                            'terms' => array($child_term_id),
                            // term slug
                        )
                    ),
                )
            );
            if ($ShutdownSearch->have_posts()) :
                while ($ShutdownSearch->have_posts()) :
                    $ShutdownSearch->the_post();

                    require(SSOL_PLUGIN_PATH . 'inc/template/loop-data.php');

                endwhile;
            endif;
            ?>

            <?php
            // get table footer
            do_action('ssol_data_table_footer');
            // pagination
            do_action('ssol_shutdown_pagination');
            ?>
        </div>
    </div>
<?php
}
