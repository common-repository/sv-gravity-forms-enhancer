<?php $color_value = isset( $props['value']['color'] ) ? esc_attr( $this->get_rgb( $props['value']['color'] ) ) : '0,0,0,1'; ?>

<div id="<?php echo $props['ID'] . '_color'; ?>" class="sv_setting">
	<div class="sv_setting_header">
		<h4 title="<?php _e( 'Toggle Color Picker', 'sv_core' ); ?>"><?php _e( 'Color', 'sv_core' ); ?></h4>
		<div
			class="sv_setting_color_display"
			title="<?php _e( 'Toggle Color Picker', 'sv_core' ); ?>"
		>
			<div
				class="sv_setting_color_value"
				style="background-color:rgba(<?php echo $color_value; ?>)"></div>
		</div>
	</div>
	<label for="<?php echo $props['ID'] . '_color'; ?>" class="sv_input_label_color sv_hidden">
		<input
			data-sv_type="sv_form_field"
			class="sv_input"
			id="<?php echo $props['ID'] . '_color'; ?>"
			name="<?php echo $props['name'] . '[color]'; ?>"
			type="color"
			value="<?php echo $this->get_hex( $color_value ); ?>"
		/>
	</label>
</div>