(function($) {

	$('#ssol-state').on('change', function() {
		var ssol_state_id = $('#ssol-state').val();
        

        console.log(SSOL_State, SSOL_State_Child_county);

		$.ajax({
			type: 'post',
			url:ssol_state_to_child.ajaxurl,
			data: {
				action:'ssol_shutdown_state_to_child',
				sssolStateId:ssol_state_id,
				//Ali_nonce:SSOLNonce,
			},
			beforeSend:function() {
                console.log('before send');
				//$('.cbwct_result_preload').addClass('cbwct_wc_order_tracker_loader');
			},
			success: function(data) {
                console.log('after send');
				$('.ssol-ajax-show-all-data').html(data);
				//$('.cbwct_result_preload').removeClass('cbwct_wc_order_tracker_loader');				
			}
		});

		return false;
	});

})(jQuery);