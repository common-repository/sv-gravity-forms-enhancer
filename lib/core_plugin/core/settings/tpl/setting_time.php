<label for="<?php echo $props['ID']; ?>">
	<input
		data-sv_type="sv_form_field"
		class="sv_input"
		id="<?php echo $props['ID']; ?>"
		name="<?php echo $props['name']; ?>"
		type="time"
		value="<?php echo esc_attr($props['value']); ?>"
		<?php echo $props['required']; ?>
		<?php echo $props['disabled']; ?> />
</label>