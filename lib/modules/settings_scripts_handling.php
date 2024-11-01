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

	class settings_scripts_handling extends modules{
		public function __construct(){
			$this->set_section_title('Scripts Handling');
			$this->set_section_desc('You can adjust handling of Gravity Form\'s scripts here.');
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
			add_action('init', array($this, 'wp_init'));
		}
		public function admin_init(){
			$this->get_root()->add_section($this);
			$this->load_settings();
			$this->run();
		}
		public function wp_init(){
			if(!is_admin()){
				$this->load_settings();
				$this->run();
			}
		}
		public function load_settings(){
			$this->s['no_css'] = static::$settings->create($this)
				->set_ID('no_css')
				->set_title('Disable CSS')
				->set_description(__('Prevents Output of Gravity Form\'s default CSS', $this->get_module_name()))
				->load_type('checkbox');

			$this->s['no_js'] = static::$settings->create($this)
				->set_ID('no_js')
				->set_title('Disable JS')
				->set_description(__('Prevents Output of Gravity Form\'s default Javascript', $this->get_module_name()))
				->load_type('checkbox');

			$this->s['in_footer'] = static::$settings->create($this)
				->set_ID('in_footer')
				->set_title('Init Scripts in Footer')
				->set_description(__('Required Scripts are loaded in Footer were possible', $this->get_module_name()))
				->load_type('checkbox');
		}
		public function run(){
			if($this->s['no_css']->get_data()){
				add_filter('pre_option_rg_gforms_disable_css', '__return_true');
			}
			if($this->s['no_js']->get_data()){
				add_filter('gform_disable_print_form_scripts', '__return_true');
			}
			if($this->s['in_footer']->get_data()){
				add_filter('gform_init_scripts_footer', '__return_true');
			}
		}
	}