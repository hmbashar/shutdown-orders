<?php
// don't call the file directly
if (!defined('ABSPATH')) exit;


// Add metabox for custom post type
function ssol_add_shutorder_metabox()
{
    add_meta_box(
        'ssol_shutorder_metabox',
        __('Shutdown Order Details', 'ssol'),
        'ssol_shutorder_metabox_callback',
        'shutorder',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'ssol_add_shutorder_metabox');


// Metabox callback function
function ssol_shutorder_metabox_callback($post)
{

    // Nonce field to verify the data when submitted
    wp_nonce_field('ssol_shutorder_metabox_nonce', 'ssol_shutorder_nonce');

    // Get existing values from the database
    $order_source = get_post_meta($post->ID, 'ssol-order-source', true);
    $order_link = get_post_meta($post->ID, 'ssol-order-link', true);
    $dates_of_order = get_post_meta($post->ID, 'ssol-dates-of-order', true);
?>
    <table style="width: 80%;">
        <tbody>
            <tr style="text-align: left;">
                <th style="width: 10%;">
                    <label for="ssol-order-source"><?php _e('Order Source:', 'ssol'); ?></label>
                </th>
                <td>
                    <input style="width:100%;padding: 6px 15px;margin-bottom: 10px;" type="text" id="ssol-order-source" name="ssol-order-source" value="<?php echo esc_attr($order_source); ?>" >
                </td>
            </tr>

            <tr style="text-align: left;">
                <th style="width: 10%;">
                    <label for="ssol-order-link"><?php _e('Order Link:', 'ssol'); ?></label>
                </th>
                <td>
                    <input style="width:100%;padding: 6px 15px;margin-bottom: 10px;"  type="text" id="ssol-order-link" name="ssol-order-link" value="<?php echo esc_attr($order_link); ?>">
                </td>
            </tr>
            <tr style="text-align: left;">
                <th style="width: 10%;">
                    <label for="ssol-dates-of-order"><?php _e('Dates of Order:', 'ssol'); ?></label>
                </th>
                <td>
                    <input style="width:100%;padding: 6px 15px;margin-bottom: 10px;"  type="text" id="ssol-dates-of-order" name="ssol-dates-of-order" value="<?php echo esc_attr($dates_of_order); ?>">
                </td>
            </tr>

        </tbody>
    </table>

<?php

}

// Save metabox data
function ssol_save_shutorder_metabox_data($post_id)
{
    // Verify nonce
    if (!isset($_POST['ssol_shutorder_nonce']) || !wp_verify_nonce($_POST['ssol_shutorder_nonce'], 'ssol_shutorder_metabox_nonce')) {
        return;
    }

    // Save data
    if (isset($_POST['ssol-order-source'])) {
        update_post_meta($post_id, 'ssol-order-source', sanitize_text_field($_POST['ssol-order-source']));
    }
    if (isset($_POST['ssol-order-link'])) {
        update_post_meta($post_id, 'ssol-order-link', sanitize_text_field($_POST['ssol-order-link']));
    }
    if (isset($_POST['ssol-dates-of-order'])) {
        update_post_meta($post_id, 'ssol-dates-of-order', sanitize_text_field($_POST['ssol-dates-of-order']));
    }
}
add_action('save_post', 'ssol_save_shutorder_metabox_data');
