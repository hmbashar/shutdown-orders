<?php
get_header();

// get the current taxonomy term id
$current_term_id = get_queried_object();
?>

<div class="ssol-single-state-archive-area">
    <div class="ssol-single-state-archive">
        <h1 class="ssol-single-state-archive-heading">
            <span><?php single_term_title(); ?></span> <br>
            Shutdown Orders
        </h1>

        <div class="ssol-short-order-area">
            <div class="ssol-short-order">

                <!--Chart Area-->
                <div id='myDiv'></div><!--Chart Area-->


                <h2>Find your state</h2>
                <form action="" method="POST" class="ssol-shutdown-order-list">

                    <label for="ssol-state">State</label>
                    <select name="selected_state" id="ssol-state">
                        <?php
                        // Get the taxonomy's terms
                        $terms = get_terms(
                            array(
                                'taxonomy'      => 'ssol-category', // taxonomy register name
                                'hide_empty'    => false, // get all taxonomy terms
                                'parent'        => 0, //get only parent taxonomy
                            )
                        );

                        // Check if any term exists
                        if (!empty($terms) && is_array($terms)) {
                            // Run a loop and print them all                            

                            foreach ($terms as $term) :
                                // Get the URL for the term
                            $term_url = get_term_link($term);
                        ?>
                               
                                <option value="<?php echo esc_attr($term->term_id); ?>" data-url="<?php echo esc_url($term_url); ?>"> <?php echo $term->name; ?></option>

                        <?php endforeach;
                        }
                        ?>
                    </select>




                    <label for="ssol-county">Find your county</label>
                    <select name="ssol_tax_child_id" id="ssol-county">
                        <?php
                        // checked if the form is submitted and get the parent taxonomy id
                        if (!empty($_POST['selected_state'])) {
                            $parent_term_id =  $_POST['selected_state']; // get parent taxonomy id from selected form
                        } else {
                            $parent_term_id =  $current_term_id->term_id; // get parent taxonomy id from current page/tax id by get_queried_object()
                        }
                        // Get only taxonomy's child terms   
                        $term_id =  $parent_term_id; // get parent taxonomy id from selected form
                        $taxonomy_name = 'ssol-category'; // get taxonomy register name
                        $termchildren = get_term_children($term_id, $taxonomy_name);
                        // set default none value option
                        echo '<option disabled selected value> -- select an option -- </option>';
                        foreach ($termchildren as $child) :
                            $term = get_term_by('id', $child, $taxonomy_name);                            
                        ?>
                            <option value="<?php echo esc_html($term->slug); ?>"><?php echo esc_html($term->name); ?></option>
                        <?php endforeach;  ?>
                    </select>



                </form>
            </div>
        </div>


        <!-- Show All data after ajax action/submit -->
        <div class="ssol-ajax-show-all-data"></div>


        <div class="ssol-state-order-list-area">
            <div class="ssol-state-order-list">
                <div class="ssol-state-order-list">

                    <h2 class="ssol-shutdown-order-heading"><?php single_term_title(); ?> State Orders</h2>
                    <?php

                    // get table header
                    require_once(SSOL_PLUGIN_PATH . 'inc/template/table-header.php');

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
                    require_once(SSOL_PLUGIN_PATH . 'inc/template/table-footer.php');
                    ?>
                    <!-- Pagination Area Start -->
                    <div class="ssol-shutdown-pagination-area">
                        <!-- Number of posts -->
                        <div class="ssol-shutdown-nfp">
                            <?php
                            // Display 'Page X of Y'
                            global $wp_query;
                            $total_pages = $wp_query->max_num_pages;
                            $current_page = max(1, get_query_var('paged'));

                            echo '<p>Page ' . $current_page . ' of ' . $total_pages . '</p>';
                            ?>
                        </div><!-- Number of posts -->

                        <div class="ssol-shutdown-pagination">
                            <?php
                            the_posts_pagination(array(
                                'mid_size' => 2, // Number of page numbers to show before and after the current page
                                'prev_text' => '&laquo;', // Text for the previous page link
                                'next_text' => '&raquo;', // Text for the next page link
                                'screen_reader_text' => ' ', // Hide default screen reader text
                            ));
                            ?>
                        </div>
                    </div><!-- Pagination Area End -->
                </div>
            </div>


        </div>
    </div>

    <?php get_footer(); ?>