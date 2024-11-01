<?php 
	$letter_spacing_number 	= intval( esc_attr( preg_replace('/[^0-9]/', '', $props['value']['spacing'] ) ) );
	$letter_spacing_unit 	= esc_attr( preg_replace('/[0-9]+/', '', $props['value']['spacing'] ) );
?>

<div id="<?php echo $props['ID'] . '_spacing'; ?>" class="sv_setting">
	<h4><?php _e( 'Letter Spacing', 'sv100' ); ?></h4>
	<label for="<?php echo $props['ID'] . '_spacing'; ?>">
		<input
			class="sv_input"
			type="number"
			value="<?php echo $letter_spacing_number; ?>"
			min="0"
		/>
		<select class="sv_input_units">
		<?php 
			foreach( $this->get_units() as $unit ) {
				if ( $unit !== '%' ) {
					echo '<option value="' . $unit . '"';
					echo $letter_spacing_unit === $unit ? ' selected' : '';
					echo '>' . $unit . '</option>';
				}
			}
		?>
		</select>
		<input
			data-sv_type="sv_form_field"
			class="sv_input"
			id="<?php echo $props['ID'] . '_spacing'; ?>"
			name="<?php echo $props['name'] . '[spacing]'; ?>"
			type="hidden"
			value="<?php echo esc_attr( $props['value']['spacing'] ); ?>"
		/>
	</label>
</div>