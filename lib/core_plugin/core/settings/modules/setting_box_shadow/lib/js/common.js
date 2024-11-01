jQuery(document).on('click', '.sv_setting_box_shadow_parent .sv_setting_color_display', function(e) {
	const color_picker = jQuery( this ).parent().find('.sv_input_label_color');

	if ( color_picker.hasClass('sv_hidden') ) {
		jQuery( color_picker ).slideDown();
		color_picker.removeClass('sv_hidden');
		const event = jQuery(document).on('click', '*', function(e) {
			if (!color_picker.is(e.target) && color_picker.has(e.target).length === 0)
			{
				jQuery( color_picker ).slideUp();
				color_picker.addClass('sv_hidden');
				jQuery(document).unbind(e);

			}
		});

	} else {
		jQuery( color_picker ).slideUp();
		color_picker.addClass('sv_hidden');
	}
});