<?php
	
	namespace sv_core;
	
	class setting_group extends settings{
		private $parent						= false;
		private $children					= array();
		private $children_clustered			= array();
		public static $initialized			= false;
		
		/**
		 * @desc			initialize
		 * @author			Matthias Bathke
		 * @since			1.0
		 * @ignore
		 */
		public function __construct($parent=false){
			$this->parent			= $parent;
		}
		public function field_callback($input){
			if($this->get_children()) {
				foreach ( $this->get_children() as $setting ) {
					if(method_exists($setting->run_type(), 'field_callback')) {
						$input = $setting->run_type()->field_callback( $input );
					}
				}
			}

			return $input;
		}
		public function add_child($setting = false){
			$child														= $setting ? $setting : static::create($this);
			$this->children[]											= $child;
			$this->children_clustered[$child->get_cluster()][]			= $child;

			return $child;
		}
		public function get_children(): array{
			return $this->children;
		}
		public function get_children_clustered(): array{
			return $this->children_clustered;
		}
		protected function group_draft_html( string $field_id = '' ) {
			return '<div class="sv_'.$this->get_module_name().'_new_draft" style="display:none;">'.$this->html_field(false,false,$field_id).'</div>';
		}
		protected function add_group_html(){
			$icon_add 				= '<svg aria-hidden="true" focusable="false" data-prefix="far" data-icon="plus-square" class="svg-inline--fa fa-plus-square fa-w-14" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path fill="currentColor" d="M352 240v32c0 6.6-5.4 12-12 12h-88v88c0 6.6-5.4 12-12 12h-32c-6.6 0-12-5.4-12-12v-88h-88c-6.6 0-12-5.4-12-12v-32c0-6.6 5.4-12 12-12h88v-88c0-6.6 5.4-12 12-12h32c6.6 0 12 5.4 12 12v88h88c6.6 0 12 5.4 12 12zm96-160v352c0 26.5-21.5 48-48 48H48c-26.5 0-48-21.5-48-48V80c0-26.5 21.5-48 48-48h352c26.5 0 48 21.5 48 48zm-48 346V86c0-3.3-2.7-6-6-6H54c-3.3 0-6 2.7-6 6v340c0 3.3 2.7 6 6 6h340c3.3 0 6-2.7 6-6z"></path></svg>';
			$output					= array();
			$output[]				= '<div class="sv_'.$this->get_module_name().'_add_new">';
			$output[]				= '<div class="sv_'.$this->get_module_name().'_add_new_button button"><i>' . $icon_add . '</i>'.__('Add', 'sv_core').'</div>';
			$output[]				= '</div>';

			return implode('',$output);
		}
		protected function html_field($i=0, $setting_id = false, string $field_id = ''){
			$icon_arrow				= '<svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="chevron-right" class="svg-inline--fa fa-chevron-right fa-w-10" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><path fill="currentColor" d="M285.476 272.971L91.132 467.314c-9.373 9.373-24.569 9.373-33.941 0l-22.667-22.667c-9.357-9.357-9.375-24.522-.04-33.901L188.505 256 34.484 101.255c-9.335-9.379-9.317-24.544.04-33.901l22.667-22.667c9.373-9.373 24.569-9.373 33.941 0L285.475 239.03c9.373 9.372 9.373 24.568.001 33.941z"></path></svg>';
			$icon_delete			= '<svg aria-hidden="true" focusable="false" data-prefix="far" data-icon="times-circle" class="svg-inline--fa fa-times-circle fa-w-16" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path fill="currentColor" d="M256 8C119 8 8 119 8 256s111 248 248 248 248-111 248-248S393 8 256 8zm0 448c-110.5 0-200-89.5-200-200S145.5 56 256 56s200 89.5 200 200-89.5 200-200 200zm101.8-262.2L295.6 256l62.2 62.2c4.7 4.7 4.7 12.3 0 17l-22.6 22.6c-4.7 4.7-12.3 4.7-17 0L256 295.6l-62.2 62.2c-4.7 4.7-12.3 4.7-17 0l-22.6-22.6c-4.7-4.7-4.7-12.3 0-17l62.2-62.2-62.2-62.2c-4.7-4.7-4.7-12.3 0-17l22.6-22.6c4.7-4.7 12.3-4.7 17 0l62.2 62.2 62.2-62.2c4.7-4.7 12.3-4.7 17 0l22.6 22.6c4.7 4.7 4.7 12.3 0 17z"></path></svg>';
			$fields					= array();
			$output					= array();

			if(count($this->get_children()) > 0){
				// allow custom labels for groups.
				$label = ($setting_id !== false ? __('Entry', 'sv_core') . ' #' . ($i + 1) : __('Group #', 'sv_core'));

				foreach($this->get_children_clustered() as $cluster_name => $cluster) {
					$fields[]		= '<h3>'.$cluster_name.'</h3>';
					foreach($cluster as $child) {
						$props = array(
							'ID' => ($setting_id !== false ? $field_id . '[' . $setting_id . '][' . $child->get_ID() . ']' : $field_id . '[sv_form_field_index][' . $child->get_ID() . ']'),
							'title' => $child->get_title(),
							'cluster' => $child->get_cluster(),
							'description' => $child->get_description(),
							'name' => ($setting_id !== false ? $field_id . '[' . $setting_id . '][' . $child->get_ID() . ']' : ''),
							'value' => (
							(
								$setting_id !== false &&
								get_option($field_id) !== false &&
								isset(get_option($field_id)[$setting_id]) &&
								isset(get_option($field_id)[$setting_id][$child->get_ID()])
							)
								? get_option($field_id)[$setting_id][$child->get_ID()]
								: $child->run_type()->get_data()),
							'required' => $child->get_required(),
							'disabled' => $child->get_disabled(),
							'placeholder' => $child->get_placeholder(),
							'maxlength' => $child->get_maxlength(),
							'minlength' => $child->get_minlength(),
							'max' => $child->get_max(),
							'min' => $child->get_min(),
							'radio_style' => $child->get_radio_style()
						);

						$fields[]			= '<div class="'.$this->get_prefix($this->get_type()).'_item">';
						$fields[]			= '<div class="sv_'.$this->get_module_name().'_input" data-sv_input_name="'.$field_id.'[sv_form_field_index]['.$child->get_ID().']'.'">'.$child->form($props);
						$fields[]			= '</div></div>';
					}

					// overwrite child group label
					// take label from custom field
					if( $child->get_is_label() ){

						if ( $setting_id !== false && isset( get_option( $field_id )[ $setting_id ][ $child->get_ID() ] )
							&& ! empty( get_option($field_id)[$setting_id][ $child->get_ID() ] ) ) {
							$label = get_option($field_id)[$setting_id][ $child->get_ID() ];
						}

					}else{

						// take label from entry label field
						if ( $setting_id !== false && isset( get_option( $field_id )[ $setting_id ]['entry_label'] )
							&& ! empty( get_option($field_id)[$setting_id]['entry_label'] ) ) {
							$label = get_option($field_id)[$setting_id]['entry_label'];
						}

					}
				}

				$header[]				= ($setting_id !== false ? '<div class="sv_'.$this->get_module_name().'" sv_'.$this->get_module_name().'_entry_id="'.$setting_id.'">' : '');
				$header[]				= '
					<div class="sv_'.$this->get_module_name().'_header">
						<h4 class="sv_' .$this->get_module_name() .'_title"><i>' . $icon_arrow . '</i> '.$label.'</h4> 
						<i class="sv_'.$this->get_module_name().'_delete">' . $icon_delete . '</i>
					</div>
					';

				$header[]			   = '<div class="sv_' . $this->get_module_name() . '_settings_wrapper">';

				$footer[]				= ($setting_id !== false ? '</div></div>' : '</div>');

				$output					= array_merge($header, $fields, $footer);
			}

			return implode('',$output);
		}
	}