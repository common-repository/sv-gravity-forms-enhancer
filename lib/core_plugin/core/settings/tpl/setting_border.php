<?php $tpl_path = $this->get_path_core( 'settings/tpl/' . $this->run_type()->get_module_name() . '_tpl/' ); ?>
<div class="sv_setting_flex">
	<?php 
		require( $tpl_path . 'border_width.php' ); 
		require( $tpl_path . 'border_style.php' ); 
	?>
</div>
<div class="sv_setting_flex">
	<?php
		require( $tpl_path . 'border_radius.php' );
		require( $tpl_path . 'border_color.php' );
	?>
</div>