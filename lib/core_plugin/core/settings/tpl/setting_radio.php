<?php
echo ( $props['radio_style'] == 'switch'
? '<div class="sv_radio_switch_wrapper"><label for="' . $props['ID'] . '"><div class="switch_field">'
			: '' );

			foreach( $this->get_options() as $o_value => $o_name ) {
			echo ( $props['radio_style'] == 'switch' ? '' : '<label for="' . $props['ID'] . '">' );
				echo
				'<input
					name="' . $props['name'] . '"
					id="' . $props['ID'] . '"
					type="radio"
					data-sv_type="sv_form_field"
					class="' . ( ( $o_value < 1 ) ? 'off' : 'on' ) . '"
					value="' . $o_value . '"
				' . $props['disabled'] . '
				' . ( ( $o_value == $props['value'] ) ? ' checked="checked" ' : '' ) . '
				/>
				<span class="name">' . $o_name . '</span>';
				echo ( $props['radio_style'] == 'switch' ? '' : '</label>' );
			}

echo ( $props['radio_style'] == 'switch' ? '</div></label></div>' : '' );