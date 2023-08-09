<?php
// Don't call the file directly
if (!defined('ABSPATH')) exit;


// Display 'Page X of Y'
function ssol_posts_number_of_pages($current_page, $total_pages)
{
	echo '<p>Page ' . $current_page . ' of ' . $total_pages . '</p>';
}
add_action('ssol_posts_number_of_pages', 'ssol_posts_number_of_pages', 10, 2);




// numbering pagination
function ssol_numbering_pagination(){
?>
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
<?php
}
add_action('ssol_numbering_pagination', 'ssol_numbering_pagination');


//number of posts ( Display 'Page X of Y' )
function ssol_number_of_pages_xoy()
{
?>
	<!-- Number of posts -->
	<div class="ssol-shutdown-nfp">
		<?php
		// Display 'Page X of Y'
		global $wp_query;
		$total_pages = $wp_query->max_num_pages;
		$current_page = max(1, get_query_var('paged'));

		do_action('ssol_posts_number_of_pages', $current_page, $total_pages);

		?>
	</div><!-- Number of posts -->

<?php
}
add_action('ssol_number_of_pages_xoy', 'ssol_number_of_pages_xoy');


//pagination with full markup
function ssol_shutdown_pagination()
{
?>
	<!-- Pagination Area Start -->
	<div class="ssol-shutdown-pagination-area">

		<?php 
			//number of posts ( Display 'Page X of Y' )
			do_action('ssol_number_of_pages_xoy');
			//numbering pagination
			do_action('ssol_numbering_pagination'); 
		
		?>

	</div><!-- Pagination Area End -->
<?php
}
add_action('ssol_shutdown_pagination', 'ssol_shutdown_pagination');



// table header
function ssol_data_table_header()
{
?>
	<div class="ssol-show-data-table-area">
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
	</div>
<?php
		}
		add_action('ssol_data_table_footer', 'ssol_data_table_footer');



		// form for select state
		function ssol_select_form($current_term_id)
		{

			//apply_filters('ssol_find_your_state', 'Find your state');
?>
	<!--Form Start-->
	<form action="" method="POST" class="ssol-shutdown-order-list">
		<!-- Nonce Validation -->
		<?php wp_nonce_field('ssol_nonce_action', 'ssol_nonce_field'); ?>

		<!--Sate to child (county) Forms -->
		<div class="ssol-state-to-child-form">
			<!--State Option-->
			<div class="ssol-state-option">
				<label for="ssol-state">
					<?php apply_filters('ssol_state_label', 'State'); ?>
				</label>
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
							// Get the URL for the term
							$term_url = get_term_link($term);
							// Check if the current term's ID matches the selected term ID
							$selected = ($term->term_id === $current_term_id->term_id) ? 'selected' : '';
					?>

							<option value="<?php echo esc_attr($term->term_id); ?>" data-url="<?php echo esc_url($term_url); ?>" <?php echo $selected; ?>> <?php echo $term->name; ?></option>

					<?php endforeach;
					}
					?>
				</select>
			</div><!--State Option-->

			<!--County Option-->
			<div class="ssol-county-option">

				<label for="ssol-county">
					<?php apply_filters('ssol_county_label', 'Find your county'); ?>
				</label>
				<select name="ssol_tax_child_id" id="ssol-county">
					<?php
					// checked if the form is submitted and get the parent taxonomy id
					if (!empty($_POST['selected_state'])) {
						$parent_term_id =  $_POST['selected_state']; // get parent taxonomy id from selected form
					} else {
						$parent_term_id =  $current_term_id->term_id; // get parent taxonomy id from current page/tax id by get_queried_object()
					}
					// Get only taxonomy's child terms   
					$term_id =  $parent_term_id; // get parent taxonomy id from selected form
					$taxonomy_name = 'ssol-category'; // get taxonomy register name
					$termchildren = get_term_children($term_id, $taxonomy_name);
					// set default none value option
					echo '<option disabled selected value> -- select an option -- </option>';
					foreach ($termchildren as $child) :
						$term = get_term_by('id', $child, $taxonomy_name);
					?>
						<option value="<?php echo esc_html($term->slug); ?>"><?php echo esc_html($term->name); ?></option>
					<?php endforeach;  ?>
				</select>
			</div><!--/ County Option-->
		</div><!--/ Sate to child (county) Forms -->
	</form><!--Form End-->
<?php
		}
		add_action('ssol_select_form', 'ssol_select_form');


		// ajax show all data for county
		function ssol_ajax_show_all_data()
		{
			echo '<div class="ssol-ajax-show-all-data"></div>';
		}
		add_action('ssol_ajax_show_all_data', 'ssol_ajax_show_all_data');
