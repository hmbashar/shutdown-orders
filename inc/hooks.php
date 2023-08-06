<?php
// Don't call the file directly
if (!defined('ABSPATH')) exit;


// Shutdown options select message
function state_and_county_required()
{
	echo __('State and county is required', 'ssol');
}
add_filter('state_and_county_required', 'state_and_county_required');



// pagination hook
function ssol_shutdown_pagination()
{
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
<?php
}
add_action('ssol_shutdown_pagination', 'ssol_shutdown_pagination');



// table header
function ssol_data_table_header()
	{
	?>
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
}
add_action('ssol_data_table_header', 'ssol_data_table_header');



	// table footer
function ssol_data_table_footer()
	{
		?>

		</tbody>
	</table>
<?php
	}
	add_action('ssol_data_table_footer', 'ssol_data_table_footer');
