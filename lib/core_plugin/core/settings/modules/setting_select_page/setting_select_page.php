<?php
	
	namespace sv_core;
	
	class setting_select_page extends settings{
		private $parent				= false;
		
		/**
		 * @desc			initialize
		 * @author			Matthias Bathke
		 * @since			1.0
		 * @ignore
		 */
		public function __construct($parent=false){
			$this->parent			= $parent;
		}
		public function sanitize($meta_value){
			return intval($meta_value);
		}
	}