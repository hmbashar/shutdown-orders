(function($) {
	// if you don't want to use ajax and want to reload then check no-ajax-state.js file
	$('#ssol-state').on('change', function() {
		var ssol_state_id = $('#ssol-state').val();    
		var ssol_state_url = $('#ssol-state').val();   
		
		// Get the selected option
		var selectedOption = $(this).find('option:selected');
		// Get the URL from the 'data-url' attribute of the selected option
		var selectedUrl = selectedOption.data('url');
		// Redirect the user to the selected URL
		window.location.href = selectedUrl;
		
		return false;


		
  		// $.ajax({
		// 	type: 'post',
		// 	url:ssol_state_to_child.ajaxurl,
		// 	data: {
				
		// 		//action:'ssol_shutdown_state_to_child',
		// 		sssolStateId:ssol_state_id,
		// 		//Ali_nonce:SSOLNonce,
		// 	},
		// 	beforeSend:function() {                
		// 		//$('.cbwct_result_preload').addClass('cbwct_wc_order_tracker_loader');
		// 	},
		// 	success: function(data) {               
		// 		$('#ssol-county').html(data);
		// 		//$('.cbwct_result_preload').removeClass('cbwct_wc_order_tracker_loader');				
		// 	}
		// });

		return false;
	});

})(jQuery);