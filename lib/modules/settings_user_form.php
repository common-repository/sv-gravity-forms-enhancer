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

	class settings_user_form extends modules{
		public function __construct(){
			$this->set_section_title('User Form');
			$this->set_section_desc('You can adjust handling of Gravity Form\'s User Forms here.');
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
			$this->s['auto_login'] = static::$settings->create($this)
				->set_ID('auto_login')
				->set_title('After Registration: Auto Login')
				->set_description(__('User will be automatically logged in after registration through Gravity Forms', $this->get_module_name()))
				->load_type('checkbox');

		}
		public function run(){
			if($this->s['auto_login']->get_data()){
				add_action('gform_user_registered', function($user_id, $config, $entry, $password){ if(!is_user_logged_in()){ wp_set_auth_cookie($user_id, false, ''); } }, 10, 4);
			}
		}
	}