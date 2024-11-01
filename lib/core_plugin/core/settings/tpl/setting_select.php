<?php
	// check for selected item
	$selected				= false;
	foreach( $this->get_options() as $o_value => $o_name ) {
		if($props['value'] === strval($o_value)){
			$selected		= $o_value;
		}
	}

	if(!$selected && $selected !== 0 && strlen($props['default_value']) > 0){
		$selected		= $props['default_value'];
	}
	//var_dump($selected);
?>
<label for="<?php echo $props['ID']; ?>">
	<select
		data-sv_type="sv_form_field"
		class="sv_input"
		id="<?php echo $props['ID']; ?>"
		name="<?php echo $props['name']; ?>"
		<?php echo $props['required']; ?>
		<?php echo $props['disabled']; ?>>
		<?php
			foreach( $this->get_options() as $o_value => $o_name ) {
				echo '<option
				' . ( ( $o_value !== false && strval($selected) === strval($o_value))  ? ' selected="selected"' : '' ) . '
				value="' . $o_value . '">' . $o_name . '</option>';
			}
		?>
	</select>
</label>