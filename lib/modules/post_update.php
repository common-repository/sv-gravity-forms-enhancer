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

	class post_update extends modules{
		public static $ext_postupdate_dont_load_post							= true;
		public static $ext_postupdate_form_cache								= array();
		public static $ext_postupdate_form_tag_cache							= false;
		
		public function __construct(){
		
		}
		/**
		 * @desc			initialize module
		 * @return	void
		 * @author			straightvisions GmbH
		 * @since			1.0
		 */
		public function init(){
			//gf post update plugin support
			add_filter('shortcode_atts_gravityforms', array($this, 'shortcode_atts_gravityforms'), 11, 3);
			add_filter('gform_pre_render', array($this, 'gform_pre_render_before'), 1, 3);
			add_filter('gform_pre_render', array($this, 'remove_empty_field_values'), 11, 3);
		}
		public function remove_empty_field_values($form, $ajax, $field_values){
			if(isset($form['fields'])) {
				foreach ($form['fields'] as $field) {
					// Start Fix by straightvisions: Empty fields are still filled with old values
					if (isset($_REQUEST['input_' . $field['id']]) && empty($_REQUEST['input_' . $field['id']])) {
					    $field['defaultValue'] = (is_array($_REQUEST['input_' . $field['id']])) ? array() : '';
					}
					// End Fix by straightvisions: Empty fields are still filled with old values
				}
			}
			return $form;
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
			// GFORM UPDATE POST: We want to prevent that fields are filled with contents for creating new posts from previous loaded instances of same form
			if(isset($atts['update'])){
				// we want to load post when update attribute is set
				static::$ext_postupdate_dont_load_post							= false;
			}else{
				// otherwise we don't want to load post
				static::$ext_postupdate_dont_load_post							= true;
				add_filter('gform_pre_render_'.$atts['id'], array($this, 'gform_pre_render_after'), 11, 3);
				
				// remove post id from form tag
				/*add_filter('gform_form_tag', function($form_tag, $form){ static::$ext_postupdate_form_tag_cache = $form_tag; return $form_tag; }, 49, 2);
				add_filter('gform_form_tag', function($form_tag, $form){ return static::$ext_postupdate_form_tag_cache; }, 51, 2);*/
				// @todo: deactivated, as this results in posts not being updated but new ones created upon post update
			}
			
			return $out;
		}
		public function gform_pre_render_before($form, $ajax, $field_values){
			if(isset($form['id'])) {
				if (!isset(static::$ext_postupdate_form_cache[$form['id']])) {
					$form_new = $form;
					if (isset($form_new['fields'])) {
						$new				= array();
						foreach ($form_new['fields'] as $field) {
							if (
								$field->type == 'post_custom_field' ||
								$field->type == 'post_title' ||
								$field->type == 'post_excerpt' ||
								$field->type == 'post_content'
							) {
								$new[] = clone $field;
							} else {
								$new[] = $field;
							}
						}
						$form_new['fields'] = $new;
					}
					static::$ext_postupdate_form_cache[$form['id']] = $form_new;
				}

				return static::$ext_postupdate_form_cache[$form['id']];
			}else{
				return $form;
			}
		}
		public function gform_pre_render_after($form, $ajax, $field_values){
			if(isset($form['id']) && static::$ext_postupdate_dont_load_post && isset(static::$ext_postupdate_form_cache[$form['id']])){
				return static::$ext_postupdate_form_cache[$form['id']];
			}else{
				return $form;
			}
		}
	}
?>