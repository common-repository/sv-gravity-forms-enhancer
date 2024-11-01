<?php

namespace sv_core;

class setting_padding extends settings{
	private $parent				= false;

	public function __construct($parent=false){
		$this->parent			= $parent;
	}
	public function get_css_data(string $custom_property = '', string $prefix = '', string $suffix = ''): array{
		// we don't support custom_property here
		$property				= array();
		$properties				= array();

		if($this->get_parent()->get_data()) {
			foreach($this->get_parent()->get_data() as $breakpoint => $val) {
				$top = (isset($val['top']) && strlen($val['top']) > 0) ? $val['top'] : false;
				$right = (isset($val['right']) && strlen($val['right']) > 0) ? $val['right'] : false;
				$bottom = (isset($val['bottom']) && strlen($val['bottom']) > 0) ? $val['bottom'] : false;
				$left = (isset($val['left']) && strlen($val['left']) > 0) ? $val['left'] : false;

				if($top !== false){
					$property['padding-top'] = $top;
				}

				if($right !== false){
					$property['padding-right'] = $right;
				}

				if($bottom !== false){
					$property['padding-bottom'] = $bottom;
				}

				if($left !== false){
					$property['padding-left'] = $left;
				}

				if($top !== false || $right !== false || $bottom !== false || $left !== false) {
					$properties[] =  $this->prepare_css_property_responsive($property, $prefix, $suffix);
				}
			}

		}

		return $properties;
	}
}