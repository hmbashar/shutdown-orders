<?php
// Don't call the file directly
if (!defined('ABSPATH')) exit;

// get header
get_header();


// get term id (current term id)
$current_term_id = get_queried_object();
?>

<!--Banner Area-->
<section class="ssol-state-list-banner-area ssol-padding">
    <div class="ssol-state-list-banner ssol-container">
        <h2>State and Local Government<br>
            COVID-19 Shutdown Orders</h2>
        <p>Since shutdown orders are used to determine eligibility for ERC, we've compiled one of the most thorough compilations of government shutdown orders and are making it available completely free of charge.

        </p>
    </div>
</section><!--/ Banner Area-->

<!--State List Area-->
<section class="ssol-state-list-area ssol-padding">
    <div class="ssol-state-lists ssol-container">
        <div class="ssol-state-list-heading">
            <h2>Choose your state</h2>
            <p>To view shutdowns at the state, city, and county level, please choose your state.</p>
        </div>
        <div class="ssol-state-content-area">
            <div class="ssol-state-list-left">
                <h3>Shutdowns by State</h3>
                <?php echo do_shortcode('[ssol_state_list]'); ?>
            </div>
            <div class="ssol-state-list-right">
                <div class="ssol-state-lsit-canvs-maps">
                    <!-- Map gose here -->
                    <?php require_once(SSOL_PLUGIN_PATH . 'inc/canvas-map.php'); ?>
                </div>
            </div>
        </div>

    </div>
</section><!--State List Area-->

<!--Chart Area-->
<section class="ssol-state-county-chart-area ssol-padding">
    <div class="ssol-sate-county-chart ssol-container">
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
</section><!--/ Chart Area-->

<!--footer content-->
<section class="ssol-footer-content-area ssol-padding">
    <div class="ssol-footer-content ssol-container">
        <p>*Please be advised that the database of shutdown orders provided by ERC Specialists, LLC is intended for convenience and referential purposes only and should not be relied upon as a legal or comprehensive list of all shutdown or other orders that may have been in place during 2020 and 2021 related to COVID-19 nor their impact upon any particular company. It is not intended to provide legal or tax advice and is provided for purely informational and educational purposes. Please be aware that nothing contained herein should be construed as legal or tax advice. If you have any questions regarding the meaning or interpretation of the orders contained within the database, we strongly encourage you to seek the advice of a licensed attorney or certified public accountant in your area. ERC Specialists, LLC disclaims any and all warranties related to this database to the fullest extent allowed by law. ERC Specialists, LLC. makes no representations or warranties of any kind, whether express or implied, as to the accuracy, completeness, timeliness, reliability, suitability, or availability of the information contained within the database.

        </p>
    </div>
</section><!--/ footer content-->


<?php
//call footer
get_footer();
