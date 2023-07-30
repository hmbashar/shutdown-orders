<?php
// Don't call the file directly
if (!defined('ABSPATH'))
    exit;



// set variable for getting value from input field
$get_ssol_state = sanitize_text_field($_POST['SSOL_State']);
$get_ssol_county = sanitize_text_field($_POST['SSOL_County']);


if (empty($get_ssol_state) || empty($get_ssol_county)) { // search field empty check
    apply_filters('state_and_county_required', 'State and county is required');
} else {
    ?>
    <div class="ssol-state-order-list-area">
        <div class="ssol-state-order-list">

            <table>
                <thead>
                    <th>Dates of Order</th>
                    <th>Order Title</th>
                    <th>Affecting</th>
                    <th>Order</th>
                    <th>Source</th>
                </thead>
                <tbody>
                    <?php
                    // checked if the form is submitted and get the child taxonomy id
                    if (!empty($get_ssol_county)) {
                        $child_term_id = $get_ssol_county;
                    } else {
                        $child_term_id = $term->term_id; // get parent taxonomy id from selected form
                    }

                    // search/shorting query                
                    $ShutdownSearch = new WP_Query(
                        array(
                            'post_type' => 'shutorder',
                            'posts_per_page' => -1,
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
                    if ($ShutdownSearch->have_posts()):
                        while ($ShutdownSearch->have_posts()):
                            $ShutdownSearch->the_post();

                            require(SSOL_PLUGIN_PATH . 'inc/template/loop-data.php');

                        endwhile;
                    endif;
                    ?>
                </tbody>
            </table>
        </div>
    </div>
    <?php
}