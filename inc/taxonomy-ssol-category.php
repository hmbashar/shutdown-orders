<?php
get_header();

// get the current taxonomy term id
$current_term_id = get_queried_object();
?>

<div class="ssol-single-state-archive-area">
    <div class="ssol-single-state-archive">
        <h1 class="ssol-single-state-archive-heading">
            <span><?php single_term_title(); ?></span> <br>
            <?php apply_filters('ssol_state_archive_heading', 'Shutdown Orders'); ?>
        </h1>

        <div class="ssol-short-order-area">
            <div class="ssol-short-order">

              

                <?php do_action('ssol_select_form', $current_term_id); ?>
            </div>
        </div>


        <!-- Show All data after ajax action/submit -->
        <?php do_action('ssol_ajax_show_all_data'); ?>


        <div class="ssol-state-order-list-area">
            <div class="ssol-state-order-list">
                <div class="ssol-state-order-list">

                    <h2 class="ssol-shutdown-order-heading">
                        <?php 
                            single_term_title(); 
                            do_action('ssol_state_archive_heading', ' Shutdown Orders');
                        ?> 
                    </h2>
                    <?php

                    // get table header
                    do_action('ssol_data_table_header');

                    if (have_posts()) : ?>
                        <?php while (have_posts()) : the_post();

                            require(SSOL_PLUGIN_PATH . 'inc/template/loop-data.php');

                        endwhile;

                        ?>
                    <?php else :
                    ?>
                        <p><?php _e('No Order found.'); ?></p>
                    <?php endif;
                    // get table footer
                    do_action('ssol_data_table_footer');
                    // get pagination
                    do_action('ssol_shutdown_pagination');

                    ?>

                </div>
            </div>


        </div>
    </div>

    <?php get_footer(); ?>