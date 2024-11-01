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

	class user_update extends modules{
		public static $user_id													= false;
		
		public function __construct(){
		
		}
		/**
		 * @desc			initialize module
		 * @return	void
		 * @author			straightvisions GmbH
		 * @since			1.0
		 */
		public function init(){
			// user registration user update support for user IDs
			add_filter('sv_gravity_forms_enhancer_replace', function($strings, $form, $unique_id){
				return array_merge($strings, array(
					'gformDeleteUploadedFile('.$form['id']							=> 'gformDeleteUploadedFile('.$unique_id,
					'gform_preview_'.$form['id']									=> 'gform_preview_'.$unique_id,
				));
			}, 10, 3);
			add_filter('shortcode_atts_gravityforms', array($this, 'shortcode_atts_gravityforms'), 11, 3);
			add_filter('gform_user_registration_update_user_id', array($this, 'gform_user_registration_update_user_id'), 11, 4);
		}
		/**
		 * @desc			
		 * @param	$out	array	The output array of shortcode attributes.
		 * @param	$pairs	array	The supported attributes and their defaults.
		 * @param	$atts	array	The user defined shortcode attributes.
		 * @return	$out	array	The output array of shortcode attributes.
		 * @author			straightvisions GmbH
		 * @since			1.0
		 */
		public function shortcode_atts_gravityforms($out, $pairs, $atts){
			// GFORM USER UPDATE: We need to somehow cache the user ID to retrieve it later
			if(isset($atts['field_values'])){
				parse_str($atts['field_values'], $field_values);
				if(isset($field_values['user_id'])){
					self::$user_id														= intval($field_values['user_id']);
					
					add_filter('gform_user_registration_update_user_id', array($this, 'gform_user_registration_update_user_id'), 10, 4);
					add_filter('gform_pre_render', array($this, 'gform_pre_render'), 99, 3);
				}else{
					add_filter('gform_pre_render', array($this, 'gform_pre_render_2'), 99, 3);
				}
			}
			
			return $out;
		}
		/**
		 * @desc			GFORM USER UPDATE: We need to somehow cache the user ID
		 * @return	array	list of IDs
		 * @author			straightvisions GmbH
		 * @since			1.0
		 */
		public function gform_user_registration_update_user_id($user_id, $entry, $form, $feed){
			$new_user_id														= false;
			if(isset($form['fields'])) {
				foreach ($form['fields'] as $field) {
					if ($field->inputName == 'user_id' || $field->adminLabel == 'user_id') {
						if (isset($_POST['input_' . $field->id]) && intval($_POST['input_' . $field->id]) > 0) {
							$new_user_id = intval($_POST['input_' . $field->id]);
						}
						if (self::$user_id) {
							if (get_userdata(self::$user_id) !== false) {
								$new_user_id = intval(self::$user_id);
							}
						}
					}
				}
			}

			return $new_user_id ? $new_user_id : $user_id;
		}
		public function gform_pre_render($form, $ajax, $field_values){
			if(class_exists('GFUser')){
				if(isset($form['fields'])) {
					foreach ($form['fields'] as $field) {
						if ($field->inputName == 'user_id') {
							$user_id = $field->get_value_submission($field_values);
						}
						remove_all_filters('gform_field_value_' . str_replace('.', '_', $field->inputName));
					}
				}
				\GFUser::maybe_prepopulate_form( $form );
			}
			
			return $form;
		}
		public function gform_pre_render_2($form, $ajax, $field_values){
			if(class_exists('GFUser')){
				foreach($form['fields'] as $field){
					if($field->inputName == 'user_id'){
						$user_id = $field->get_value_submission($field_values);
					}
					remove_all_filters('gform_field_value_'.str_replace('.', '_', $field->inputName));
					add_filter('gform_field_value_gfur_field_'.$field->id, function() use($field){ return $field->defaultValue; }, 99);
				}
				\GFUser::maybe_prepopulate_form( $form );
			}

			return $form;
		}
	}
?>