function sv_ajax_fragmented_requests(form){
	jQuery(form).find('.sv_ajax_fragmented_requests_start > *').hide();
	jQuery(form).find('.sv_ajax_fragmented_requests_start .processing').show();

	var data				= {
		'action'			: 'sv_ajax_fragmented_requests',
		'per_cycle'			: sv_ajax_fragmented_requests_vars[form.data('id')]['per_cycle'],
		'step'				: sv_ajax_fragmented_requests_vars[form.data('id')]['step'],
		'ID'				: form.data('id'),
	};

	jQuery.post(ajaxurl, data, function(response){
		form.find('.sv_ajax_fragmented_requests_log').append(response);

		var percentage		= 100/sv_ajax_fragmented_requests_vars[form.data('id')]['total_cycles']*sv_ajax_fragmented_requests_vars[form.data('id')]['step'];

		form.find('.sv_ajax_fragmented_requests_progress_bar').progressbar({
			value: percentage
		});

		form.find('.sv_ajax_fragmented_requests_progress_text .left').html((Math.round(percentage * 100) / 100)+'%');
		form.find('.sv_ajax_fragmented_requests_progress_text .center').html(sv_ajax_fragmented_requests_vars[form.data('id')]['step']+'/'+sv_ajax_fragmented_requests_vars[form.data('id')]['total_cycles']+' Cycles');
		form.find('.sv_ajax_fragmented_requests_progress_text .right').html(form.find('.sv_ajax_fragmented_requests_log').children('div.notice').length+'/'+sv_ajax_fragmented_requests_vars[form.data('id')]['total']+' Entries - '+form.find('.sv_ajax_fragmented_requests_log').children('div.notice-error').length+' Errors');

		if(parseInt(sv_ajax_fragmented_requests_vars[form.data('id')]['step']) < parseInt(sv_ajax_fragmented_requests_vars[form.data('id')]['total_cycles'])){
			sv_ajax_fragmented_requests_vars[form.data('id')]['step'] = parseInt(sv_ajax_fragmented_requests_vars[form.data('id')]['step'])+1;
			sv_ajax_fragmented_requests(form);
		}else{
			jQuery(form).find('.sv_ajax_fragmented_requests_start > *').hide();
			jQuery(form).find('.sv_ajax_fragmented_requests_start .finished').show();
			// todo: empty cached cycle var
		}
	}).fail(function() {
		sv_ajax_fragmented_requests(form);
	});
}

jQuery(document).ready(function(){
	// progressbar
	jQuery('#sv_ajax_fragmented_requests_status_progress_bar').progressbar({
		value: 0
	});

	jQuery('.sv_ajax_fragmented_requests').one('submit', function(e){
		e.preventDefault();
		var form				= jQuery(this);
		form.find('.sv_ajax_fragmented_requests_log').append('<h2>Log</h2>');
		form.find('.sv_ajax_fragmented_requests_start, .sv_ajax_fragmented_requests_continue').attr('disabled', 'disabled');

		sv_ajax_fragmented_requests_vars[form.data('id')]['step'] = 1;
		sv_ajax_fragmented_requests_vars[form.data('id')]['step'] = 1;

		// ajax
		sv_ajax_fragmented_requests(form);
	});

	// continue
	jQuery('.sv_ajax_fragmented_requests_continue').one('click', function(e){
		e.preventDefault();
		var form				= jQuery(this).parent();
		form.find('.sv_ajax_fragmented_requests_log').append('<h2>Log</h2>');
		form.find('.sv_ajax_fragmented_requests_start, .sv_ajax_fragmented_requests_continue').attr('disabled', 'disabled');

		// ajax
		sv_ajax_fragmented_requests(form);
	});
});