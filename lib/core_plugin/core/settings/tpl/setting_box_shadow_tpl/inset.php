<div id="<?php echo $props['ID'] . '_inset'; ?>" class="sv_setting">
	<h4><?php _e( 'Shadow Style', 'sv100' ); ?></h4>
	<label for="<?php echo $props['ID'] . '_deco'; ?>" class="sv_setting_box_shadow_inset">
		<select class="sv_input">
		<?php 
			$shadow_style = array( 'outline', 'inset' );
			$shadow_style_val = $props['value'][0] === 'inset' ? 'inset' : 'outline';
			
			foreach( $shadow_style as $style ) {
				echo '<option value="' . $style . '"';
				echo $shadow_style_val === $style ? ' selected' : '';
				echo '>' . $style . '</option>';
			}
		?>
		</select>
	</label>
</div>