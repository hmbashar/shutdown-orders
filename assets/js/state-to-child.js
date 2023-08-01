(function($) {

	$('#ssol-state').on('change', function() {
		var ssol_state_id = $('#ssol-state').val();    
		
		$.ajax({
			type: 'post',
			url:ssol_state_to_child.ajaxurl,
			data: {
				action:'ssol_shutdown_state_to_child',
				sssolStateId:ssol_state_id,
				//Ali_nonce:SSOLNonce,
			},
			beforeSend:function() {                
				//$('.cbwct_result_preload').addClass('cbwct_wc_order_tracker_loader');
			},
			success: function(data) {               
				$('#ssol-county').html(data);
				//$('.cbwct_result_preload').removeClass('cbwct_wc_order_tracker_loader');				
			}
		});

		return false;
	});

})(jQuery);