<?php
// Don't call the file directly
if (!defined('ABSPATH')) exit;

// get header
get_header();
?>

<div class="ssol-short-order-area">
    <div class="ssol-short-order">
        <h2>Find your state</h2>
        <form action="" method="POST">
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
                    ?>                    
                        <option value="<?php echo $term->term_id; ?>"> <?php echo $term->name; ?></option>

                <?php endforeach;
                }
                ?>
            </select>

            <label for="ssol-county">Find your county</label>
            <select name="ssol_tax_child_id" id="ssol-county">
                <?php
                // checked if the form is submitted and get the parent taxonomy id
                if(!empty($_POST['selected_state'])) {
                    $parent_term_id =  $_POST['selected_state']; // get parent taxonomy id from selected form
                } else {
                    $parent_term_id =  $term->term_id; // get parent taxonomy id from selected form
                }
                // Get only taxonomy's child terms   
                $term_id =  $parent_term_id; // get parent taxonomy id from selected form
                $taxonomy_name = 'ssol-category'; // get taxonomy register name
                $termchildren = get_term_children($term_id, $taxonomy_name);
                foreach ($termchildren as $child) :
                    $term = get_term_by('id', $child, $taxonomy_name);
                ?>
                    <option value="<?php echo esc_html($term->slug); ?>"><?php echo esc_html($term->name); ?></option>
                <?php endforeach; ?>
            </select>
            <button type="submit">Submit</button>
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
                // checked if the form is submitted and get the child taxonomy id
                if(!empty($_POST['ssol_tax_child_id'])) {
                    $child_term_id = $_POST['ssol_tax_child_id'];
                } else {
                    $child_term_id =  $term->term_id; // get parent taxonomy id from selected form
                }

                // search/shorting query                
                $ShutdownSearch = new WP_Query(
                    array(
                        'post_type' => 'shutorder',
                        'posts_per_page' => -1,
                        'tax_query' => array(
                            array(
                                'taxonomy' => 'ssol-category', // taxonomy name
                                'field' => 'slug', // term slug
                                'terms' => array($child_term_id), // term slug
                            )
                        ),
                    )
                );
                if ($ShutdownSearch->have_posts()) :
                    while ($ShutdownSearch->have_posts()) : $ShutdownSearch->the_post();

                        require(SSOL_PLUGIN_PATH . 'inc/template/loop-data.php');

                    endwhile;
                endif;               
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
                ?>
            </tbody>
        </table>
    </div>
</div>

<?php
//call footer
get_footer();
