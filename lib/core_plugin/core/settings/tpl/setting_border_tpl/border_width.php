<?php
	// Default
	$border_top_width		   = '0px';
	$border_right_width		 = '0px';
	$border_bottom_width		= '0px';
	$border_left_width		  = '0px';

	$border_top_width_number	= 0;
	$border_right_width_number  = 0;
	$border_bottom_width_number = 0;
	$border_left_width_number   = 0;

	$border_top_width_unit	  = 'px';
	$border_right_width_unit	= 'px';
	$border_bottom_width_unit   = 'px';
	$border_left_width_unit	 = 'px';

	if ( isset( $props['value'] ) ) {
		if ( isset( $props['value']['top_width'] ) && ! empty( $props['value']['top_width'] ) ) {
			$border_top_width		   = esc_attr( $props['value']['top_width'] );
			$border_top_width_number 	= intval( esc_attr( preg_replace('/[^0-9]/', '', $border_top_width ) ) );
			$border_top_width_unit	  = esc_attr( preg_replace('/[0-9]+/', '', $border_top_width ) );
		}

		if ( isset( $props['value']['right_width'] ) && ! empty( $props['value']['right_width'] ) ) {
			$border_right_width		 = esc_attr( $props['value']['right_width'] );
			$border_right_width_number 	= intval( esc_attr( preg_replace('/[^0-9]/', '', $border_right_width ) ) );
			$border_right_width_unit	= esc_attr( preg_replace('/[0-9]+/', '', $border_right_width ) );
		}

		if ( isset( $props['value']['bottom_width'] ) && ! empty( $props['value']['bottom_width'] ) ) {
			$border_bottom_width		= esc_attr( $props['value']['bottom_width'] );
			$border_bottom_width_number = intval( esc_attr( preg_replace('/[^0-9]/', '', $border_bottom_width ) ) );
			$border_bottom_width_unit   = esc_attr( preg_replace('/[0-9]+/', '', $border_bottom_width ) );
		}

		if ( isset( $props['value']['left_width'] ) && ! empty( $props['value']['left_width'] ) ) {
			$border_left_width		  = esc_attr( $props['value']['left_width'] );
			$border_left_width_number 	= intval( esc_attr( preg_replace('/[^0-9]/', '', $border_left_width ) ) );
			$border_left_width_unit	 = esc_attr( preg_replace('/[0-9]+/', '', $border_left_width ) );
		}
	}
?>

<div id="<?php echo $props['ID'] . '_width'; ?>" class="sv_setting">
	<h4><?php _e( 'Border Width', 'sv100' ); ?></h4>
	<table class="sv_setting_border">
		<tr>
			<td colspan="3">
				<label for="<?php echo $props['ID'] . '_top_width'; ?>">
					<input
						class="sv_input"
						type="number"
						value="<?php echo $border_top_width_number; ?>"
						min="0"
					/>
					<select class="sv_input_units">
					<?php 
						foreach( $this->get_units() as $unit ) {
							if ( $unit !== '%' ) {
								echo '<option value="' . $unit . '"';
								echo $border_top_width_unit === $unit ? ' selected' : '';
								echo '>' . $unit . '</option>';
							}
						}
					?>
					</select>
					<input
						data-sv_type="sv_form_field"
						class="sv_input"
						id="<?php echo $props['ID'] . '_top_width'; ?>"
						name="<?php echo $props['name'] . '[top_width]'; ?>"
						type="hidden"
						value="<?php echo $border_top_width; ?>"
					/>
				</label>
			</td>
		</tr>
		<tr>
			<td>
				<label for="<?php echo $props['ID'] . '_left_width'; ?>">
					<input
						class="sv_input"
						type="number"
						value="<?php echo $border_left_width_number; ?>"
						min="0"
					/>
					<select class="sv_input_units">
					<?php 
						foreach( $this->get_units() as $unit ) {
							if ( $unit !== '%' ) {
								echo '<option value="' . $unit . '"';
								echo $border_left_width_unit === $unit ? ' selected' : '';
								echo '>' . $unit . '</option>';
							}
						}
					?>
					</select>
					<input
						data-sv_type="sv_form_field"
						class="sv_input"
						id="<?php echo $props['ID'] . '_left_width'; ?>"
						name="<?php echo $props['name'] . '[left_width]'; ?>"
						type="hidden"
						value="<?php echo $border_left_width; ?>"
					/>
				</label>
			</td>
			<td style="width:100px;height:100px;">Content</td>
			<td>
				<label for="<?php echo $props['ID'] . '_right_width'; ?>">
					<input
						class="sv_input"
						type="number"
						value="<?php echo $border_right_width_number; ?>"
						min="0"
					/>
					<select class="sv_input_units">
					<?php 
						foreach( $this->get_units() as $unit ) {
							if ( $unit !== '%' ) {
								echo '<option value="' . $unit . '"';
								echo $border_right_width_unit === $unit ? ' selected' : '';
								echo '>' . $unit . '</option>';
							}
						}
					?>
					</select>
					<input
						data-sv_type="sv_form_field"
						class="sv_input"
						id="<?php echo $props['ID'] . '_right_width'; ?>"
						name="<?php echo $props['name'] . '[right_width]'; ?>"
						type="hidden"
						value="<?php echo $border_right_width; ?>"
					/>
				</label>
			</td>
		</tr>
		<tr>
			<td colspan="3">
				<label for="<?php echo $props['ID'] . '_bottom_width'; ?>">
					<input
						class="sv_input"
						type="number"
						value="<?php echo $border_bottom_width_number; ?>"
						min="0"
					/>
					<select class="sv_input_units">
					<?php 
						foreach( $this->get_units() as $unit ) {
							if ( $unit !== '%' ) {
								echo '<option value="' . $unit . '"';
								echo $border_bottom_width_unit === $unit ? ' selected' : '';
								echo '>' . $unit . '</option>';
							}
						}
					?>
					</select>
					<input
						data-sv_type="sv_form_field"
						class="sv_input"
						id="<?php echo $props['ID'] . '_bottom_width'; ?>"
						name="<?php echo $props['name'] . '[bottom_width]'; ?>"
						type="hidden"
						value="<?php echo $border_bottom_width; ?>"
					/>
				</label>
			</td>
		</tr>
	</table>
</div>