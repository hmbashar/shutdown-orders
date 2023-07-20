<?php 
// Don't call the file directly
if ( !defined( 'ABSPATH' ) ) exit;

// get header
get_header(); 
?>

<div class="ssol-short-order-area">
    <div class="ssol-short-order">
        <form action="">
            <label for="ssol-state">State</label>
            <select name="" id="ssol-state">
                <option value="">Alaska</option>
                <option value="">Alaska</option>
                <option value="">Alaska</option>
            </select>
            <label for="ssol-county">Find your country</label>
            <select name="" id="ssol-county">
                <option value="">Kenai City</option>
                <option value="">Kenai City</option>
                <option value="">Kenai City</option>
            </select>
        </form>
    </div>
</div>

<div class="ssol-state-order-list-area">
    <div class="ssol-state-order-list">
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
                
                $shutdown = new WP_Query(
                    array(
                        'post_type' => 'shutorder',
                        'posts_per_page' => -1,
                        'order' => 'DESC',
                        'orderby' => 'date',
                    )
                );

                if($shutdown->have_posts()) :
                    while($shutdown->have_posts()) : $shutdown->the_post();
                    
                    //date of order
                    $shutdown_date_of_order = get_post_meta(get_the_ID(), 'ssol-dates-of-order', true);
                    
                    //order link
                    $shutdown_order_link = get_post_meta(get_the_ID(), 'ssol-order-link', true);
                    
                    //order source
                    $shutdown_order_source = get_post_meta(get_the_ID(), 'ssol-order-source',  true);
                ?>
                <tr>

                    <?php if(!empty($shutdown_date_of_order)) : ?>
                        <td><?php echo esc_html($shutdown_date_of_order); ?></td>
                    <?php endif; ?>
                    
                    <td><?php the_title(); ?></td>
                    <td><?php the_excerpt(); ?></td>


                    <?php if(!empty($shutdown_order_link)) : ?>

                    <td><a href="<?php echo esc_url($shutdown_order_link); ?>">Link</a></td>

                    <?php endif; ?>

                    <?php if(!empty($shutdown_order_source)) : ?>
                        <td><a href="<?php echo esc_url($shutdown_order_source); ?>">Link</a></td>    
                    <?php endif; ?>
                   
                </tr>
                <?php 
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