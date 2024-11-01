<form class="sv_ajax_fragmented_requests" data-id="<?php echo $prefix; ?>">
		<button class="sv_ajax_fragmented_requests_start button button-primary">
			<span class="start"><span class="label"><?php _e('Start', 'sv_core'); ?></span><i class="fas fa-play"></i></span>
			<span class="processing"><span class="label"><?php _e('Processing','sv_core'); ?></span><i class="fas fa-cog fa-spin"></i></span>
			<span class="finished"><span class="label"><?php _e('Finished', 'sv_core'); ?></span><i class="fas fa-check-circle"></i></span>
		</button>
		<?php if(get_transient($prefix)){ ?>
			<button class="sv_ajax_fragmented_requests_continue button button-secondary"><?php _e('Continue Import from Cycle', 'sv_core'); ?> <?php echo get_transient($prefix); ?></button>
		<?php } ?>
	<div class="sv_ajax_fragmented_requests_progress_bar"></div>
	<div class="sv_ajax_fragmented_requests_progress_text"><div class="left"></div><div class="center"></div><div class="right"></div></div>
	<div class="sv_ajax_fragmented_requests_log"></div>
</form>