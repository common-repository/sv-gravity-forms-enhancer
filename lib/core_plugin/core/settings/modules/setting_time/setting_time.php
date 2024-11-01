<?php
	namespace sv_core;
	
	class setting_time extends settings{
		private $parent				= false;
		
		/**
		 * @desc			initialize
		 * @author			Dennis Heiden
		 * @since			3.123
		 * @ignore
		 */
		public function __construct($parent=false){
			$this->parent			= $parent;
		}
	}