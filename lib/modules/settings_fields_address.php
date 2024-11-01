<?php
	/**
	 * @author			straightvisions GmbH
	 * @package			sv_gravity_forms_enhancer
	 * @copyright		2017 straightvisions GmbH
	 * @link			https://straightvisions.com/
	 * @since			1.0
	 * @license			See license.txt or https://straightvisions.com/
	 */

	namespace sv_gravity_forms_enhancer;

	class settings_fields_address extends modules{
		public function __construct(){
			$this->set_section_title('Address Fields');
			$this->set_section_desc('Adjust field behavior here');
			$this->set_section_type('settings');
		}

		/**
		 * @desc            initialize module
		 * @return    void
		 * @author            straightvisions GmbH
		 * @since            1.0
		 */
		public function init(){
			add_action('admin_init', array($this, 'admin_init'));
			
			if(!is_admin()) {
				$this->load_settings();
				$this->run();
			}
		}
		public function admin_init(){
			$this->get_root()->add_section($this);
			$this->load_settings();
		}
		public function load_settings(){
			$this->s['zip_before_city'] = static::$settings->create($this)
				->set_ID('zip_before_city')
				->set_title('Address: Show ZIP before City')
				->set_description(__('Display ZIP in address field before City', $this->get_module_name()))
				->load_type('checkbox');
		}
		public function run(){
			if($this->s['zip_before_city']->get_data()){
				add_filter('gform_address_display_format', function(){ return 'zip_before_city'; });
			}
		}
	}