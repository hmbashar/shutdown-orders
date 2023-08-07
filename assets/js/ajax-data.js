(function ($) {

	// Create a function to handle fetching posts
	function fetchPosts(SSOL_State, SSOL_County, paged) {
		$.ajax({
			type: 'post',
			url: ssol_option_data.ajaxurl,
			data: {
				action: 'ssol_shutdown_submit_result',
				SSOL_State: SSOL_State,
				SSOL_County: SSOL_County,
				paged: paged, // Send the page number
			},
			beforeSend: function () {
				// ...
			},
			success: function (data) {
				$('.ssol-ajax-show-all-data').html(data);
				// ...
			}
		});
	}

	// Handle county select change
	$('#ssol-county').on('change', function () {
		var SSOL_State = $('#ssol-state').val();
		var SSOL_County = $(this).val();

		fetchPosts(SSOL_State, SSOL_County, 1); // Query the first page when county changes
	});

	// Handle pagination link clicks
	$(document).on('click', '.ssol-county-pagination a', function (event) {
		event.preventDefault();
		var page = $(this).attr('href').split('paged=')[1]; // Extract page number from URL
		var SSOL_State = $('#ssol-state').val();
		var SSOL_County = $('#ssol-county').val();

		fetchPosts(SSOL_State, SSOL_County, page); // Query specific page on pagination link click
	});


})(jQuery);