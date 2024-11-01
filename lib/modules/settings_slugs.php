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

	class settings_slugs extends modules{
		private $filtered							= false;
		private $titles_to_ids						= array();
		private $slugs_to_ids						= array();

		public function __construct(){
			$this->set_section_title('Slugs');
			$this->set_section_desc('Form-IDs may change in your deployment-process - slugs are better.');
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
						$this->s['slugs_' . $form['id']] = static::$settings->create($this)
							->set_ID('slugs_' . $form['id'])
							->set_title('Slug for Form #' . $form['id'])
							->set_description($form['title'])
							->load_type('text')
							->set_placeholder(sanitize_title($form['title']));
						
						$this->titles_to_ids[sanitize_title($form['title'])] = $form['id'];
						
						if ($this->s['slugs_' . $form['id']]->get_data()) {
							$this->slugs_to_ids[$this->s['slugs_' . $form['id']]->get_data()] = $form['id'];
						}
					}
				}
			}
		}
		public function run(){
			add_filter('gform_pre_render', array($this,'gform_pre_render'), 1, 1);
			add_filter('gform_shortcode_form', array($this,'gform_shortcode_form'), 1, 3);
		}
		public function get_id_by_title(string $title): int{
			if(isset($this->titles_to_ids[$title])){
				return $this->titles_to_ids[$title];
			}else{
				return 0;
			}
		}
		public function get_id_by_slug(string $slug): int{
			if(isset($this->slugs_to_ids[$slug])){
				return $this->slugs_to_ids[$slug];
			}else{
				return 0;
			}
		}
		public function gform_shortcode_form( $string, $attributes, $content ) {
			if(!$this->filtered) {
				$this->filtered		= true;

				if($this->get_id_by_title($attributes['id'])) {
					// check for sanitized title as name
					$attributes['id'] = $this->get_id_by_title($attributes['id']);
				}elseif($this->get_id_by_slug($attributes['id'])){
					// check for custom name
					$attributes['id'] = $this->get_id_by_slug($attributes['id']);
				}
				$string = \GFForms::parse_shortcode($attributes, $content);
			}
			return $string;
		}
		public function gform_pre_render( $form ) {
			// fix for error log warnings in userregistration addon if id or fields are empty
			if(isset($form['fields'])){
				return $form;
			}else{
				$form['id'] = 0;
				$form['fields'] = array();
				return $form;
			}
		}
	}