(function($) {

	$('#ssol-state, #ssol-county').on('change', function() {
		var SSOL_State = $('#ssol-state').val();
		var SSOL_State_Child_county = $('#ssol-county').val();
        

        console.log(SSOL_State, SSOL_State_Child_county);

		$.ajax({
			type: 'post',
			url:ssol_option_data.ajaxurl,
			data: {
				action:'ssol_shutdown_submit_result',
				SSOL_State:SSOL_State,
				SSOL_County:SSOL_State_Child_county,
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