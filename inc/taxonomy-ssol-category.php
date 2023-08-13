<?php
get_header();

$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

// get the current taxonomy term id
$current_term_id = get_queried_object();
?>


<main class="ssol-single-state-archive-area">
    <section class="ssol-single-state-archive">
        <!--Banner Area-->
        <section class="ssol-state-list-banner-area ssol-padding">
            <div class="ssol-state-list-banner ssol-container">
                <div class="ssol-back-to-all-state">
                    <a href="https://shutdown.yourswp.com/covid-19-page/"><img src="<?php echo SSOL_PLUGIN_DIR ?>/assets/img/arrow.svg" alt=""> Back To All Sates</a>
                </div>
                <h1 class="ssol-single-state-archive-heading">
                    <span><?php single_term_title(); ?></span> <br>
                    <?php apply_filters('ssol_state_archive_heading', 'Shutdown Orders'); ?>
                </h1>
            </div>
        </section><!--/ Banner Area-->



        <div class="ssol-short-order-area">
            <div class="ssol-short-order ssol-container">
                <?php do_action('ssol_select_form', $current_term_id); ?>
                <!--Preloading-->
                <?php do_action('ssol_preloader', 'ssol_county_ajax_posts'); ?>
               <!--/ Preloading-->

            </div>
        </div>

        <!-- Show All data after ajax action/submit -->
        <?php do_action('ssol_ajax_show_all_data'); ?>


        <!-- Show State Data for current term page -->
        <div class="ssol-state-order-list-area">
            <div class="ssol-state-order-list ssol-container">
                <div class="ssol-state-order-list">

                    <h2 class="ssol-shutdown-order-heading">
                        <?php
                        single_term_title();
                        do_action('ssol_state_archive_heading', ' Shutdown Orders');
                        ?>
                    </h2>

                    
                    <!--Ajax Post will be loaded here-->
                    <div id="ssol-single-term-post-ajax-container">
                        <!-- Posts will be loaded here -->
                    </div><!--/ Ajax Post will be loaded here-->

                    <!--Preloading-->
                    <?php do_action('ssol_preloader', 'ssol_term_general_posts'); ?>
                    <!--/ Preloading-->


                    <?php
                    // Add the custom loop for pagination
                    $args = array(
                        'post_type' => 'shutorder',
                        'posts_per_page' => 10,
                        'paged' => $paged,
                        'tax_query' => array(
                            array(
                                'taxonomy' => 'ssol-category',
                                'field' => 'term_id',
                                'terms' => $current_term_id->term_id,
                                'include_children' => false,
                            )
                        ),
                    );
                    $query = new WP_Query($args);
                    ?>
                    <!-- Pagination Area Start -->
                    <div class="ssol-shutdown-pagination-area">
                        <!-- number of pages  -->
                        <div class="ssol-ajax-county-nfp">
                            <?php echo sprintf(__('Page <span class="ssol-tax-qur-current-page"> %1$d </span> of <span class="total-pages">%2$d</span>', 'ssol'), $paged, $query->max_num_pages) ?>
                        </div><!-- number of pages  -->

                        <!-- Pagination -->
                        <div class="ssol-shutdown-pagination">
                            <div class="pagination">
                                <?php
                                echo paginate_links(array(
                                    'total' => $query->max_num_pages,
                                    'current' => $paged,
                                    'show_all' => true,
                                ));
                                ?>
                            </div>
                        </div><!--/ Pagination -->
                    </div><!-- Pagination Area End -->
                </div>
            </div>
        </div><!--/ Show State Data for current term page -->


        <!--footer content
        <section class="ssol-footer-content-area ssol-padding">
            <div class="ssol-footer-content ssol-container">   
            </div>
        </section>--/ footer content-->
    </section>
</main>


<?php get_footer(); ?>