<div id="<?php echo $props['ID'] . '_blur_radius'; ?>" class="sv_setting">
	<h4><?php _e( 'Blur Radius', 'sv100' ); ?></h4>
	<label for="<?php echo $props['ID'] . '_blur_radius'; ?>" class="sv_setting_range sv_setting_box_shadow_blur">
		<?php 
			$blur_radius_value  = esc_attr( $props['value'][0] === 'inset' ? $props['value'][3] : $props['value'][2] );
			$blur_radius_number = intval( esc_attr( preg_replace('/[^0-9]/', '', $blur_radius_value ) ) );
			$blur_radius_unit 	= esc_attr( preg_replace('/[0-9]+/', '', $blur_radius_value ) );
		?>
		<input
			class="sv_input"
			type="range"
			value="<?php echo $blur_radius_number; ?>"
			max="300"
			min="0"
		/>
		<input
			class="sv_input sv_input_range_indicator"
			type="number"
			value="<?php echo $blur_radius_number; ?>"
			max="300"
			min="0"
		/>
		<select class="sv_input_units">
		<?php 
			foreach( $this->get_units() as $unit ) {
				if ( $unit !== '%' ) {
					echo '<option value="' . $unit . '"';
					echo $blur_radius_unit === $unit ? ' selected' : '';
					echo '>' . $unit . '</option>';
				}
			}
		?>
		</select>
	</label>
</div>