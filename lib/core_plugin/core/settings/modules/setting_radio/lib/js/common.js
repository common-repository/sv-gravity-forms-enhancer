jQuery(document).on('click', '.sv_radio_switch_wrapper .switch_field input[type="radio"]:checked', function() {
	jQuery( '.sv_radio_switch_wrapper .switch_field input[type="radio"]:not(:checked)' ).prop( 'checked', true );
	jQuery( this ).removeProp( 'checked' );
});