<?php
// Don't call the file directly
if (!defined('ABSPATH')) exit;

// get header
get_header();
?>



<div class="ssol-short-order-area">
    <div class="ssol-short-order">
        <div id='myDiv'></div>
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
                ?>
                        <option value="<?php echo $term->term_id; ?>" > <?php echo $term->name; ?></option>

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



        </form>
    </div>
</div>


<!-- Show All data after ajax action/submit -->
<div class="ssol-ajax-show-all-data"></div>


<div class="ssol-state-order-list-area">
    <div class="ssol-state-order-list">


        <!-- // This is the regular order list -->
        <!-- <?php
                $selected_terms = get_term_by('slug', $get_ssol_county, 'ssol-category');   // get selected taxonomy term by slug                   
                ?>
        <h2 class="ssol-shutdown-order-heading"><?php echo esc_html($selected_terms->name); ?> County Orders</h2> -->


        <?php
        
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (isset($_POST["selected_state"])) {
                $selectedValue = $_POST["selected_state"];
                echo "Selected state value: " . $selectedValue;
            }
        }

        // get table header
        require_once(SSOL_PLUGIN_PATH . 'inc/template/table-header.php');

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
        require_once(SSOL_PLUGIN_PATH . 'inc/template/table-footer.php');
        ?>
    </div>
</div>

<?php
//call footer
get_footer();
