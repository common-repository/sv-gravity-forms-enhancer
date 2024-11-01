<?php 
$tpl_path	= $this->get_path_core( 'settings/tpl/' . $this->run_type()->get_module_name() . '_tpl/' ); 
$props['value'] 		= $props['value'] ? $props['value'] : '0px 0px 0px 0px #000000';
$props['value']			= explode( ' ', $props['value'] );
?>

<div class="sv_setting_box_shadow">
	<div class="sv_setting_flex">
	<?php 
		require( $tpl_path . 'horizontal_length.php' ); 
		require( $tpl_path . 'vertical_length.php' ); 
	?>
	</div>
	<div class="sv_setting_flex">
	<?php 
		require( $tpl_path . 'blur_radius.php' ); 
		require( $tpl_path . 'spread_radius.php' ); 
	?>
	</div>
	<div class="sv_setting_flex">
	<?php 
		require( $tpl_path . 'color.php' );
		require( $tpl_path . 'inset.php' );
	?>
	</div>
	<div class="sv_setting sv_setting_preview">
		<h3><?php _e( 'Preview', 'sv100' ); ?></h3>
	</div>
	<input
		data-sv_type="sv_form_field"
		class="sv_input"
		id="<?php echo $props['ID']; ?>"
		name="<?php echo $props['name']; ?>"
		type="hidden"
		value="<?php echo esc_attr( $props['value'] ); ?>"
	/>
</div>

<style>
.sv_setting_box_shadow_parent .sv_setting_preview {
	box-shadow: <?php echo esc_attr( $props['value'] ); ?>;
}
</style>