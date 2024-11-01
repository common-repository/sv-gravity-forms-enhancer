<?php if ( current_user_can( 'activate_plugins' ) ) { ?>
	<div class="sv_setting_subpage">
		<h2><?php _e('General', 'sv100'); ?></h2>
		<div class="sv_setting_flex">
			<?php
				echo $module->get_setting( 'flush_css_cache' )->form();
				echo $module->get_setting( 'disable_all_css' )->form();
				echo $module->get_setting( 'disable_all_js' )->form();
			?>
		</div>
	</div>
<?php } ?>