<div id="<?php echo $props['ID'] . '_vertical_length'; ?>" class="sv_setting">
	<h4><?php _e( 'Vertical Length', 'sv100' ); ?></h4>
	<label for="<?php echo $props['ID'] . '_vertical_length'; ?>" class="sv_setting_range sv_setting_box_shadow_vertical">
		<?php 
			$vertical_length_value  = esc_attr( $props['value'][0] === 'inset' ? $props['value'][2] : $props['value'][1] );
			$vertical_length_number = intval( esc_attr( preg_replace('/[^0-9]/', '', $vertical_length_value ) ) );
			$vertical_length_unit 	= esc_attr( preg_replace('/[0-9]+/', '', $vertical_length_value ) );
		?>
		<input
			class="sv_input"
			type="range"
			value="<?php echo $vertical_length_number; ?>"
			max="200"
			min="0"
		/>
		<input
			class="sv_input sv_input_range_indicator"
			type="number"
			value="<?php echo $vertical_length_number; ?>"
			max="200"
			min="0"
		/>
		<select class="sv_input_units">
		<?php 
			foreach( $this->get_units() as $unit ) {
				if ( $unit !== '%' ) {
					echo '<option value="' . $unit . '"';
					echo $vertical_length_unit === $unit ? ' selected' : '';
					echo '>' . $unit . '</option>';
				}
			}
		?>
		</select>
	</label>
</div>