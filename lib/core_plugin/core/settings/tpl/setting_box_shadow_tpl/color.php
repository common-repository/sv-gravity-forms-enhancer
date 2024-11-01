<?php $color = esc_attr( $props['value']['color'] ? $this->get_rgb( $props['value']['color']) : 'transparent' ); ?>
<script>
	jQuery( document ).ready( function() {
		if ( typeof SVColorPicker !== 'undefined' ) {
			SVColorPicker.renderColorPicker( '<?php echo $props['name'] . '[color]'; ?>', '<?php echo $color; ?>');
		}
	} );
</script>
<div class="sv_setting">
	<div class="sv_setting_header">
		<h4 title="<?php _e( 'Toggle Color Picker', 'sv_core' ); ?>"><?php _e( 'Shadow Color', 'sv_core' ); ?></h4>
	</div>
	<div class="sv_setting_color_display" title="<?php _e( 'Toggle Color Picker', 'sv_core' ); ?>">
		<div class="sv_setting_color_value" style="background-color:rgba(<?php echo $color; ?>)"></div>
	</div>
	<label for="<?php echo $props['name'] . '[color]'; ?>" class="sv_input_label_color sv_hidden">
		<input
			data-sv_type="sv_form_field"
			class="sv_input"
			id="<?php echo $props['name'] . '[color]'; ?>"
			name="<?php echo $props['name'] . '[color]'; ?>"
			type="color"
			value="<?php echo $color; ?>"
		/>
	</label>
</div>