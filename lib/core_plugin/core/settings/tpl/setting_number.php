<label for="<?php echo $props['ID']; ?>">
	<?php 
		if ( $this->get_is_units() ) { 
			$val_number = intval( esc_attr( preg_replace('/[^0-9]/', '', $props['value'] ) ) );
			$val_unit = esc_attr( preg_replace('/[0-9]+/', '', $props['value'] ) );
	?>
		<input
			class="sv_input"
			type="number"
			placeholder="<?php echo $props['placeholder']; ?>"
			value="<?php echo $val_number; ?>"
			<?php echo $props['max'] ? 'max="'.$props['max'].'"' : ''; ?>
			<?php echo $props['min'] ? 'min="'.$props['min'].'"' : ''; ?>
			<?php 
				echo ( $props['maxlength'] ? 'maxlength="'.$props['maxlength'].'"' :  '' ). '"
				' . $props['minlength'] . '
				' . $props['required'] . '
				' . $props['disabled'];
			?> 
		/>
	<select class="sv_input_units">
	<?php 
		foreach( $this->get_units() as $unit ) {
			echo '<option value="' . $unit . '"';
			echo $val_unit === $unit ? ' selected' : '';
			echo '>' . $unit . '</option>';
		}
	?>
	</select>
	<input
		data-sv_type="sv_form_field"
		class="sv_input"
		id="<?php echo $props['ID']; ?>"
		name="<?php echo $props['name']; ?>"
		type="hidden"
		value="<?php echo esc_attr( $props['value'] ); ?>"
	/>
	<?php } else { ?>
		<input
			data-sv_type="sv_form_field"
			class="sv_input"
			id="<?php echo $props['ID']; ?>"
			name="<?php echo $props['name']; ?>"
			type="number"
			placeholder="<?php echo $props['placeholder']; ?>"
			value="<?php echo esc_attr($props['value']); ?>"
			max="<?php echo $props['max']; ?>"
			min="<?php echo $props['min']; ?>"
			<?php 
				echo ($props['maxlength'] ? 'maxlength="'.$props['maxlength'].'"' :  ''). '"
				' . $props['minlength'] . '
				' . $props['required'] . '
				' . $props['disabled'];
			?> 
		/>
	<?php } ?>
</label>