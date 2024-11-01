<div id="<?php echo $props['ID'] . '_spread_radius'; ?>" class="sv_setting">
	<h4><?php _e( 'Spread Radius', 'sv100' ); ?></h4>
	<label for="<?php echo $props['ID'] . '_spread_radius'; ?>" class="sv_setting_range sv_setting_box_shadow_spread">
		<?php 
			$spread_radius_value	= esc_attr( $props['value'][0] === 'inset' ? $props['value'][3] : $props['value'][2] );
			$spread_radius_number   = intval( esc_attr( preg_replace('/[^0-9]/', '', $spread_radius_value ) ) );
			$spread_radius_unit	 = esc_attr( preg_replace('/[0-9]+/', '', $spread_radius_value ) );
		?>
		<input
			class="sv_input"
			type="range"
			value="<?php echo $spread_radius_number; ?>"
			max="300"
			min="0"
		/>
		<input
			class="sv_input sv_input_range_indicator"
			type="number"
			value="<?php echo $spread_radius_number; ?>"
			max="300"
			min="0"
		/>
		<select class="sv_input_units">
		<?php 
			foreach( $this->get_units() as $unit ) {
				if ( $unit !== '%' ) {
					echo '<option value="' . $unit . '"';
					echo $spread_radius_unit === $unit ? ' selected' : '';
					echo '>' . $unit . '</option>';
				}
			}
		?>
		</select>
	</label>
</div>