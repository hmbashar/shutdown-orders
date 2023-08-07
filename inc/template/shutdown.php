<?php
// Don't call the file directly
if (!defined('ABSPATH')) exit;

// get header
get_header();


// it's wrong way to get current term id, because of it's not a tarm page, it's a regular page, so it should be change later, I wil change it leter
$current_term_id = get_queried_object();
?>



<div class="ssol-short-order-area">
    <div class="ssol-short-order">
        <div id='ssol_chart_data'></div>

        <?php do_action('ssol_select_form', $current_term_id); ?>

    </div>
</div>


<!-- Show All data after ajax action/submit -->
<div class="ssol-ajax-show-all-data"></div>


<div class="ssol-state-order-list-area">
    <div class="ssol-state-order-list">


        <?php
        
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (isset($_POST["selected_state"])) {
                $selectedValue = $_POST["selected_state"];
                echo "Selected state value: " . $selectedValue;
            }
        }

        // get table header
        do_action('ssol_data_table_header');

        // regular shutdown order query
        $shutdown = new WP_Query(
            array(
                'post_type' => 'shutorder',
                'posts_per_page' => -1,
                'order' => 'DESC',
                'orderby' => 'date',
            )
        );

        if ($shutdown->have_posts()) :
            while ($shutdown->have_posts()) : $shutdown->the_post();

                require(SSOL_PLUGIN_PATH . 'inc/template/loop-data.php');

            endwhile;
        endif;

        // get table footer
        do_action('ssol_data_table_footer');
        ?>
    </div>
</div>

<?php
//call footer
get_footer();
