<?php 
	$font_size_number 	= intval( esc_attr( preg_replace('/[^0-9]/', '', $props['value']['size'] ) ) );
	$font_size_unit 	= esc_attr( preg_replace('/[0-9]+/', '', $props['value']['size'] ) );
?>

<div id="<?php echo $props['ID'] . '_size'; ?>" class="sv_setting">
	<h4><?php _e( 'Font Size', 'sv100' ); ?></h4>
	<label for="<?php echo $props['ID'] . '_size'; ?>">
		<input
			class="sv_input"
			type="number"
			value="<?php echo $font_size_number; ?>"
			min="0"
		/>
		<select class="sv_input_units">
		<?php 
			foreach( $this->get_units() as $unit ) {
				echo '<option value="' . $unit . '"';
				echo $font_size_unit === $unit ? ' selected' : '';
				echo '>' . $unit . '</option>';
			}
		?>
		</select>
		<input
			data-sv_type="sv_form_field"
			class="sv_input"
			id="<?php echo $props['ID'] . '_size'; ?>"
			name="<?php echo $props['name'] . '[size]'; ?>"
			type="hidden"
			value="<?php echo esc_attr( $props['value']['size'] ); ?>"
		/>
	</label>
</div>