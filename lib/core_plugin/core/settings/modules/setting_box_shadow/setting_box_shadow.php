<?php

namespace sv_core;

class setting_box_shadow extends settings {
	private $parent	= false;

	public function __construct( $parent = false ){
		$this->parent = $parent;

		add_action( 'after_setup_theme', array( $this, 'after_setup_theme' ) );
	}

	public function after_setup_theme() {
		/* Enables the SV Color Picker for the color setting */
		$color_input_id = $this->get_parent()->get_field_id() . '_color';
		$color_input_value = '#000000';

		if ( $this->get_parent()->get_data() && isset( $this->get_parent()->get_data()['color'] ) ) {
			$color_input_value = $this->get_parent()->get_data()['color'];
		}

		$this->setting_color->localize_script( $color_input_id, $color_input_value );
	}
}