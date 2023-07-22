<?php
// Don't call the file directly
if (!defined('ABSPATH')) exit;

// get header
get_header();
?>

<div class="ssol-short-order-area">
    <div class="ssol-short-order">
        <form action="">
            <label for="ssol-state">State</label>
            <select name="" id="ssol-state">
                <?php
                // Get the taxonomy's terms
                $terms = get_terms(
                    array(
                        'taxonomy'      => 'ssol-category', // get taxonomy 
                        'hide_empty'    => false, // get all taxonomy terms
                        'parent'        => 0, //get only parent taxonomy
                    )
                );

                // Check if any term exists
                if (!empty($terms) && is_array($terms)) {
                    // Run a loop and print them all
                    foreach ($terms as $term) : ?>
                        <option value=""> <a href="<?php echo esc_url(get_term_link($term)) ?>">
                                <?php echo $term->name; ?>
                            </a></option>

                <?php endforeach;
                }
                ?>
            </select>

            <label for="ssol-county">Find your country</label>
            <select name="" id="ssol-county">
                <?php
                // Get the taxonomy's child terms   
                $term_id = 7;
                $taxonomy_name = 'ssol-category';
                $termchildren = get_term_children($term_id, $taxonomy_name);
                foreach ($termchildren as $child) :
                    $term = get_term_by('id', $child, $taxonomy_name);
                ?>
                    <option value=""><?php echo esc_html($term->name); ?></option>
                <?php endforeach; ?>
            </select>
        </form>
    </div>
</div>

<div class="ssol-state-order-list-area">
    <div class="ssol-state-order-list">

    <!-- // This is the shorting part of the code -->
    <h2>This is the shorting shutdown order</h2>
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
                // search/shorting query                
                $ShutdownSearch = new WP_Query(
                    array(
                        'post_type' => 'shutorder',
                        'posts_per_page' => -1,
                        'tax_query' => array(
                            //'relation' => 'AND',
                            array(
                                'taxonomy' => 'ssol-category', // taxonomy name
                                'field' => 'slug', // term slug
                                'terms' => array('alabama'), // term slug
                            )
                        ),
                    )
                );
                if ($ShutdownSearch->have_posts()) :
                    while ($ShutdownSearch->have_posts()) : $ShutdownSearch->the_post();

                        require(SSOL_PLUGIN_PATH . 'inc/template/loop-data.php');

                    endwhile;
                endif;
                wp_reset_query();
                ?>
            </tbody>
        </table>

        <!-- // This is the regular order list -->
        <h2>This is the regular shutdown order</h2>
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
                wp_reset_query();
                ?>
            </tbody>
        </table>
    </div>
</div>

<?php
//call footer
get_footer();
