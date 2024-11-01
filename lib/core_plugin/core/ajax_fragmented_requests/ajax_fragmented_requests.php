<?php
	/**
	 * @author			Matthias Bathke
	 * @package			sv_bb_dashboard
	 * @copyright		2018 Matthias Bathke
	 * @link			https://straightvisions.com/
	 * @since			1.0
	 * @license			See license.txt or https://straightvisions.com/
	 */

	namespace sv_core;
	
	class ajax_fragmented_requests extends sv_abstract{

		private $settings_js = '';

		public function init(){
		
		}
		public function scripts_common(){
			wp_enqueue_script('jquery-ui-core');
			wp_enqueue_script('jquery-ui-widget');
			wp_enqueue_script('jquery-ui-progressbar');
			wp_enqueue_script('sv_ajax_fragmented_requests', $this->get_url_core($this->get_module_name().'/backend/js/'.$this->get_module_name().'.js'), array('jquery-ui-core'), filemtime($this->get_path_core($this->get_module_name().'/backend/js/'.$this->get_module_name().'.js')), true);

			wp_enqueue_style('jquery-ui-css', $this->get_url_core($this->get_module_name().'/backend/css/jquery-ui.css'));
			wp_enqueue_style($this->get_prefix('backend'), $this->get_url_core($this->get_module_name().'/backend/css/'.$this->get_module_name().'.css'));
		}
		public function scripts_block(array $forms){

			foreach ($forms as $ID => $vars) {
				$this->settings_js .= 'sv_ajax_fragmented_requests_vars["' . $ID . '"] = ' . json_encode(array(
						'total' => $vars['total'],
						'total_cycles' => ceil($vars['total'] / $vars['amount_per_cycle']),
						'per_cycle' => $vars['amount_per_cycle'],
						'step' => intval(get_transient($ID))
					)).';';
			}

			wp_localize_script('sv_ajax_fragmented_requests', 'sv_ajax_fragmented_requests_vars', array(
				'l10n_print_after' => $this->settings_js
			));
		}
		public function load_form(string $prefix = ''){
			include($this->get_path_core($this->get_module_name().'/backend/tpl/form.php'));
		}
	}
