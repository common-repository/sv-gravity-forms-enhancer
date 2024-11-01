<div id="<?php echo $props['ID'] . '_weight'; ?>" class="sv_setting">
	<h4><?php _e( 'Font Weight', 'sv100' ); ?></h4>
	<label for="<?php echo $props['ID'] . '_weight'; ?>">
		<select
			data-sv_type="sv_form_field"
			class="sv_input"
			id="<?php echo $props['ID'] . '_weight'; ?>"
			name="<?php echo $props['name'] . '[weight]'; ?>"
		>
		<?php 
			for( $x = 1; $x < 10; $x++ ) {
				echo '<option value="' . $x . '00"';
				echo $props['value']['weight'] === $x . '00' ? ' selected' : '';
				echo '>' . $x . '00</option>';
			}
		?>
		</select>
	</label>
</div>