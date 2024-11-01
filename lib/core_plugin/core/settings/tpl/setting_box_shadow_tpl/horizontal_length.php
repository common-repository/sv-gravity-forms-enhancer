<div id="<?php echo $props['ID'] . '_horizontal_length'; ?>" class="sv_setting">
	<h4><?php _e( 'Horizontal Length', 'sv100' ); ?></h4>
	<label for="<?php echo $props['ID'] . '_horiztontal_length'; ?>" class="sv_setting_range sv_setting_box_shadow_horizontal">
	<?php 
		$horizontal_length_value	= esc_attr( $props['value'][0] === 'inset' ? $props['value'][1] : $props['value'][0] );
		$horizontal_length_number 	= intval( esc_attr( preg_replace('/[^0-9]/', '', $horizontal_length_value ) ) );
		$horizontal_length_unit 	= esc_attr( preg_replace('/[0-9]+/', '', $horizontal_length_value ) );
	?>
		<input
			class="sv_input"
			type="range"
			value="<?php echo $horizontal_length_number; ?>"
			max="200"
			min="0"
		/>
		<input
			class="sv_input sv_input_range_indicator"
			type="number"
			value="<?php echo $horizontal_length_number; ?>"
			max="200"
			min="0"
		/>
		<select class="sv_input_units">
		<?php 
			foreach( $this->get_units() as $unit ) {
				if ( $unit !== '%' ) {
					echo '<option value="' . $unit . '"';
					echo $horizontal_length_unit === $unit ? ' selected' : '';
					echo '>' . $unit . '</option>';
				}
			}
		?>
		</select>
	</label>
</div>