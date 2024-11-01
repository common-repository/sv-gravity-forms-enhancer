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

	class settings_disable_entries extends modules{
		public function __construct(){
			$this->set_section_title('Disable Entry Creation');
			$this->set_section_desc	('If a form has file upload fields, this feature will be not be applied on that.');
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
			if(class_exists('\GFAPI')) {
				$forms = \GFAPI::get_forms();
				if (is_array($forms) && count($forms) > 0) {
					foreach ($forms as $form) {
						$this->s['disable_entries_' . $form['id']] = static::$settings->create($this)
							->set_ID('disable_entries_' . $form['id'])
							->set_title('Disable for Form #' . $form['id'])
							->set_description($form['title'])
							->load_type('checkbox');
					}
				}
			}
		}
		public function run(){
			add_action('gform_after_submission', array($this, 'disable_entry_creation'), 999, 2);
		}
		public function disable_entry_creation($entry, $form){
			if(class_exists('\GFAPI')) {
				if ($this->s['disable_entries_' . $form['id']]->get_data() == '1') {
					$fields = \GFCommon::get_fields_by_type($form, array('fileupload', 'post_image'));
					
					if (is_array($fields)) { // delete only if no uploads are made
						return;
					}
					\GFAPI::delete_entry($entry['id']);
				}
			}
		}
	}