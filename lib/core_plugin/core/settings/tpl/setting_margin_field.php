<?php 
	$value = '';

	if ( isset( $props['value'] ) && is_array( $props['value'] ) ) {
		if ( isset( $props['value'][$sub] ) && is_string( $props['value'][$sub] ) ) {
			$value = $props['value'][$sub];
		}
	} else if ( isset( $props['default_value'] ) && is_array( $props['default_value'] ) ) {
		if ( isset( $props['default_value'][$sub] ) && is_string( $props['default_value'][$sub] ) ) {
			$value = $props['default_value'][$sub];
		}
	}
?>

<label for="<?php echo $props['ID']; ?>_<?php echo $sub; ?>">
	<input
		data-sv_type="sv_form_field"
		class="sv_input"
		id="<?php echo $props['ID']; ?>_<?php echo $sub; ?>"
		name="<?php echo $props['name']; ?>[<?php echo $sub; ?>]"
		type="text"
		placeholder="<?php echo __($sub, 'sv_core'); ?>"
		value="<?php echo $value; ?>"
		<?php echo  ($props['maxlength'] ? 'maxlength="'.$props['maxlength'].'"' :  ''); ?>
		<?php echo $props['minlength']; ?>
		<?php echo $props['required']; ?>
		<?php echo $props['disabled']; ?>
	/>
</label>