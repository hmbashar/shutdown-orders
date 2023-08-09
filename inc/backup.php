
<?php

// get table header
do_action('ssol_data_table_header');

$args = array(
    'post_type'      => 'shutorder',
    'posts_per_page' => 1,
    'paged'          => $paged,
);
$portfolio_query = new WP_Query($args);

if ($portfolio_query->have_posts()) : ?>
    <?php while ($portfolio_query->have_posts()) : $portfolio_query->the_post();

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