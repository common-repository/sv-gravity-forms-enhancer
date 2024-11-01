jQuery(document).bind('gform_post_render gform_post_conditional_logic_field_action gform_post_conditional_logic', function(event, form_id, current_page){
    jQuery('.gform_wrapper form .wp-editor-area').each(function(){
		if(typeof jQuery(this).attr('id') != 'undefined'){
			var sv_mce_id = jQuery(this).attr('id');
			setTimeout(function(){ tinymce.execCommand('mceAddEditor', false, sv_mce_id); }, 400);
		}
	});
});

// this fixes that enhanced UI feature is normally not initiated on invisible elements.
function sv_gformInitChosenFields(fieldList, noResultsText){
    return jQuery(fieldList).each(function(){
        var element = jQuery( this );

        // RTL support
        if( jQuery( 'html' ).attr( 'dir' ) == 'rtl' ) {
            element.addClass( 'chosen-rtl chzn-rtl' );
        }

        // only initialize once
        if( /*element.is(":visible") && */element.siblings(".chosen-container").length == 0 ){
            var options = gform.applyFilters( 'gform_chosen_options', { no_results_text: noResultsText }, element );
            element.chosen( options );
        }

    });
}

// we will give the chosen a fallback width of 100%
gform.addFilter('gform_chosen_options', 'sv_gform_chosen_options');
function sv_gform_chosen_options(options, element){
	options.width		= '100%';
	return options;
}