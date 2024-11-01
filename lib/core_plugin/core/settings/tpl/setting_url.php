<label for="<?php echo $props['ID']; ?>">
	<input
		data-sv_type="sv_form_field"
		class="sv_input"
		id="<?php echo $props['ID']; ?>"
		name="<?php echo $props['name']; ?>"
		type="url"
		placeholder="<?php echo $props['placeholder']; ?>"
		value="<?php echo esc_attr($props['value']); ?>"
		<?php echo ($props['maxlength'] ? 'maxlength="'.$props['maxlength'].'"' :  ''); ?>
		<?php echo $props['minlength']; ?>
		<?php echo $props['required']; ?>
		<?php echo $props['disabled']; ?> />
</label>