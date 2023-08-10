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
                    <a href=""><img src="<?php echo SSOL_PLUGIN_DIR ?>/assets/img/arrow.svg" alt=""> Back To All Sates</a>
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
                        'posts_per_page' => 1,
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
                                ));
                                ?>
                            </div>
                        </div><!--/ Pagination -->
                    </div><!-- Pagination Area End -->
                </div>
            </div>
        </div><!--/ Show State Data for current term page -->


        <!--footer content-->
        <section class="ssol-footer-content-area ssol-padding">
            <div class="ssol-footer-content ssol-container">
                <p>*Please be advised that the database of shutdown orders provided by ERC Specialists, LLC is intended for convenience and referential purposes only and should not be relied upon as a legal or comprehensive list of all shutdown or other orders that may have been in place during 2020 and 2021 related to COVID-19 nor their impact upon any particular company. It is not intended to provide legal or tax advice and is provided for purely informational and educational purposes. Please be aware that nothing contained herein should be construed as legal or tax advice. If you have any questions regarding the meaning or interpretation of the orders contained within the database, we strongly encourage you to seek the advice of a licensed attorney or certified public accountant in your area. ERC Specialists, LLC disclaims any and all warranties related to this database to the fullest extent allowed by law. ERC Specialists, LLC. makes no representations or warranties of any kind, whether express or implied, as to the accuracy, completeness, timeliness, reliability, suitability, or availability of the information contained within the database.

                </p>
            </div>
        </section><!--/ footer content-->
    </section>
</main>


<?php get_footer(); ?>