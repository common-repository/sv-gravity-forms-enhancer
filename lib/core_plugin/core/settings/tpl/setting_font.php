<?php $tpl_path = $this->get_path_core( 'settings/tpl/' . $this->run_type()->get_module_name() . '_tpl/' ); ?>

<div class="sv_setting_flex">
	<?php 
		require( $tpl_path . 'font_family.php' ); 
		require( $tpl_path . 'font_size.php' ); 
		require( $tpl_path . 'font_weight.php' ); 
		require( $tpl_path . 'line_height.php' ); 
	?>
</div>
<div class="sv_setting_flex">
	<?php 
		require( $tpl_path . 'color.php' ); 
		require( $tpl_path . 'text_decoration.php' ); 
		require( $tpl_path . 'text_transform.php' );
		require( $tpl_path . 'letter_spacing.php' );
	?>
</div>