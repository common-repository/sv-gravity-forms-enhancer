<?php
	
	namespace sv_core;
	
	class setting_number extends settings{
		private $parent	= false;
		
		/**
		 * @desc			initialize
		 * @author			Matthias Bathke
		 * @since			1.0
		 * @ignore
		 */
		public function __construct($parent=false){
			$this->parent = $parent;
		}

		public function sanitize($meta_value) {
			return intval($meta_value);
		}
		public function get_css_data(string $custom_property = '', string $prefix = '', string $suffix = ''): array{
			$property				= ((strlen($custom_property) > 0) ? $custom_property : false);
			$properties				= array();

			// this input field is generic, so custom property is required
			if($property && $this->get_parent()->get_data()) {
				$properties[$property]		= $this->prepare_css_property_responsive($this->get_parent()->get_data(),$prefix,$suffix);
			}

			return $properties;
		}
	}