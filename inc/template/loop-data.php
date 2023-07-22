<?php
// don't call the file directly
if (!defined('ABSPATH')) exit;


//date of order
$shutdown_date_of_order = get_post_meta(get_the_ID(), 'ssol-dates-of-order', true);

//order link
$shutdown_order_link = get_post_meta(get_the_ID(), 'ssol-order-link', true);

//order source
$shutdown_order_source = get_post_meta(get_the_ID(), 'ssol-order-source',  true);
?>
<tr>

    <?php if (!empty($shutdown_date_of_order)) : ?>
        <td><?php echo esc_html($shutdown_date_of_order); ?></td>
    <?php endif; ?>

    <td><?php the_title(); ?></td>
    <td><?php the_excerpt(); ?></td>


    <?php if (!empty($shutdown_order_link)) : ?>

        <td><a href="<?php echo esc_url($shutdown_order_link); ?>">Link</a></td>

    <?php endif; ?>

    <?php if (!empty($shutdown_order_source)) : ?>
        <td><a href="<?php echo esc_url($shutdown_order_source); ?>">Link</a></td>
    <?php endif; ?>

</tr>