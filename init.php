<?php
	namespace sv_gravity_forms_enhancer;

	if(!class_exists('\sv_core\core_plugin')) {
		require_once(dirname(__FILE__) . '/lib/core_plugin/core_plugin.php');
	}
	
	class init extends \sv_core\core_plugin {
		const version = 1900;
		const version_core_match = 9000;
		
		public function load(){
			if(!$this->setup( __NAMESPACE__, __FILE__ )){
				return false;
			}
			
			$this->set_section_title( __( 'SV Gravity Forms Enhancer', 'sv_gravity_forms_enhancer' ) );
			$this->set_section_desc( __( 'Improves Gravity Forms in various ways',  'sv_gravity_forms_enhancer' ) );
			$this->set_section_privacy( '<p>' . $this->get_section_title() . __(' does not collect or share any data, but extends Gravity Forms plugin which has it\'s own privacy rules.',  'sv_gravity_forms_enhancer').'</p>' );
		}
	}
	
	$GLOBALS[ __NAMESPACE__ ] = new init();
	$GLOBALS[ __NAMESPACE__ ]->load();