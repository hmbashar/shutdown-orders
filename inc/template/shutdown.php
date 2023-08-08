<?php
// Don't call the file directly
if (!defined('ABSPATH')) exit;

// get header
get_header();


// it's wrong way to get current term id, because of it's not a tarm page, it's a regular page, so it should be change later, I wil change it leter
$current_term_id = get_queried_object();
?>
<!--Banner Area-->
<section class="ssol-state-list-banner-area">
    <div class="ssol-state-list-banner">
        <h2>State and Local Government
            COVID-19 Shutdown Orders</h2>
        <p>Since shutdown orders are used to determine eligibility for ERC, we've compiled one of the most thorough compilations of government shutdown orders and are making it available completely free of charge.

        </p>
    </div>
</section><!--/ Banner Area-->

<!--State List Area-->
<section class="ssol-state-list-area">
    <h2 class="ssol-state-list-heading">Choose your state</h2>
    <div class="ssol-state-list-left">
        <h3>Shutdowns by State</h3>
        <?php echo do_shortcode('[ssol_state_list]'); ?>
    </div>
    <div class="ssol-state-list-right">
        <div class="ssol-state-lsit-canvs-maps">
            <!-- Map gose here -->
        </div>
    </div>
</section><!--State List Area-->

<section class="ssol-state-county-chart-area">
    <div class="ssol-sate-county-chart">
        <!--Chart title part-->
        <div class="ssol-sate-county-title">
            <h2>Shutdowns by State</h2>
            <div class="ssol-sate-color-identify">
                <!--Single Color-->
                <div class="ssol-single-color">
                    <div class="ssol-single-color-box ssol-box-state"></div>
                    <p>State</p>
                </div><!--Single Color-->  
                <!--Single Color-->
                <div class="ssol-single-color">
                    <div class="ssol-single-color-box ssol-box-conuty"></div>
                    <p>County</p>
                </div><!--Single Color-->
            </div>
        </div><!--/ Chart title part-->
        <div class="ssol-chartbar-data-area">
            <?php echo do_shortcode('[ssol_chart_data]'); ?>
        </div>
    </div>
</section>


<?php
//call footer
get_footer();
