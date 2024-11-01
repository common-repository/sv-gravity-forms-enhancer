<?php

namespace sv_core;

class setting_border extends settings {
	private $parent	= false;

	public function __construct( $parent = false ){
		$this->parent = $parent;
	}
	public function get_css_data(string $custom_property = '', string $prefix = '', string $suffix = ''): array{
		$properties			= array();

		if($this->get_parent()->get_data()) {
			foreach ($this->get_parent()->get_data() as $breakpoint => $query) {
				if(!isset($query['color']) || $query['color'] == 'transparent,undefined,undefined,undefined') {
					$query['color'] = '0,0,0,0';
				}

				if (isset($query['top_width']) && isset($query['top_style'])) {
					$val = $query['top_width'] . ' ' . $query['top_style'] . ' rgba(' . $query['color'] . ')';
					$properties['border-top'][$breakpoint] = $val;
				}

				if (isset($query['right_width']) && isset($query['right_style'])) {
					$val = $query['right_width'] . ' ' . $query['right_style'] . ' rgba(' . $query['color'] . ')';
					$properties['border-right'][$breakpoint] = $val;
				}

				if (isset($query['bottom_width']) && isset($query['bottom_style'])) {
					$val = $query['bottom_width'] . ' ' . $query['bottom_style'] . ' rgba(' . $query['color'] . ')';
					$properties['border-bottom'][$breakpoint] = $val;
				}

				if (isset($query['left_width']) && isset($query['left_style'])) {
					$val = $query['left_width'] . ' ' . $query['left_style'] . ' rgba(' . $query['color'] . ')';
					$properties['border-left'][$breakpoint] = $val;
				}

				$top_left_radius = (empty($query['top_left_radius'])) ? 0 : $query['top_left_radius'];
				$top_right_radius = (empty($query['top_right_radius'])) ? 0 : $query['top_right_radius'];
				$bottom_right_radius = (empty($query['bottom_right_radius'])) ? 0 : $query['bottom_right_radius'];
				$bottom_left_radius = (empty($query['bottom_left_radius'])) ? 0 : $query['bottom_left_radius'];

				$query_radius = $top_left_radius . ' ' . $top_right_radius . ' ' . $bottom_right_radius . ' ' . $bottom_left_radius . '';
				$properties['border-radius'][$breakpoint] = $query_radius;
			}
		}

		return $properties;
	}
}
