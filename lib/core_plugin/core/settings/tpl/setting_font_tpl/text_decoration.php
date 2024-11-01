<div id="<?php echo $props['ID'] . '_deco'; ?>" class="sv_setting">
	<h4><?php _e( 'Text Decoration', 'sv100' ); ?></h4>
	<label for="<?php echo $props['ID'] . '_deco'; ?>">
		<select
			data-sv_type="sv_form_field"
			class="sv_input"
			id="<?php echo $props['ID'] . '_deco'; ?>"
			name="<?php echo $props['name'] . '[deco]'; ?>"
		>
		<?php 
			$text_deco_options = array( 'none', 'underline', 'line-through', 'overline' );
			
			foreach( $text_deco_options as $deco ) {
				echo '<option value="' . $deco . '"';
				echo $props['value']['deco'] === $deco ? ' selected' : '';
				echo '>' . $deco . '</option>';
			}
		?>
		</select>
	</label>
</div>