<div id="<?php echo $props['ID'] . '_transform'; ?>" class="sv_setting">
	<h4><?php _e( 'Text Transform', 'sv100' ); ?></h4>
	<label for="<?php echo $props['ID'] . '_transform'; ?>">
		<select
			data-sv_type="sv_form_field"
			class="sv_input"
			id="<?php echo $props['ID'] . '_transform'; ?>"
			name="<?php echo $props['name'] . '[transform]'; ?>"
		>
		<?php 
			$text_transform_options = array( 'none', 'capitalize', 'lowercase', 'uppercase' );
			
			foreach( $text_transform_options as $transform ) {
				echo '<option value="' . $transform . '"';
				echo $props['value']['transform'] === $transform ? ' selected' : '';
				echo '>' . $transform . '</option>';
			}
		?>
		</select>
	</label>
</div>