<?php
	
	namespace sv_core;
	
	class widgets extends sv_abstract{
		private $ID									= false;
		private $title								= false;
		private $description						= false;
		private $settings							= array();
		public static $scripts_loaded				= false;
		private $widget_class_name					= false;
		private $template_path						= '';
		
		/**
		 * @desc			initialize
		 * @author			Matthias Bathke
		 * @since			1.0
		 * @ignore
		 */
		public function __construct(){
		
		}
		/**
		 * @desc			Load's requested libraries dynamicly
		 * @param	string	$name library-name
		 * @return			class object of the requested library
		 * @author			Matthias Bathke
		 * @since			1.0
		 * @ignore
		 */
		public function __get(string $name){
			if($this->get_path_core($this->get_module_name().'/modules/'.$name.'.php')){ // look for class file in modules directory
				require_once($this->get_path_core($this->get_module_name().'/modules/'.$name.'.php'));
				$classname							= __NAMESPACE__.'\\'.$name;
				
				$this->$name						= new $classname($this);
				return $this->$name;
			}else{
				throw new \Exception('Class '.$name.' could not be loaded (tried to load class-file '.$this->get_path_core($this->get_module_name().'/modules/'.$name.'.php').')');
			}
		}
		public function set_ID(string $ID){
			$this->ID								= $ID;
			return $this;
		}
		public function get_ID(): string{
			return $this->ID;
		}
		public function set_title(string $title){
			$this->title							= $title;
			return $this;
		}
		public function get_title(): string{
			return $this->title;
		}
		public function set_description(string $description){
			$this->description						= $description;
			return $this;
		}
		public function get_description(){
			return $this->description;
		}
		public function set_widget_settings(array $settings){
			$this->settings							= $settings;
			return $this;
		}
		public function get_widget_settings(): array{
			return $this->settings;
		}
		public function set_template_path($path){
			$this->template_path					= $this->get_parent()->get_path($path);
			return $this;
		}
		public function get_template_path(): string{
			return $this->template_path;
		}
		public function get_template($args, $instance){
			include($this->get_template_path());
		}
		
		// OBJECT METHODS
		public function create($parent){
			$new									= new self();
			$new->set_parent($parent);
			$new->set_root($parent->get_root());
			
			$new->init();
			return $new;
		}
		public function load(): string{
			add_action('widgets_init', function () {
				register_widget($this->get_widget_class_name());
			});
			return $this->widget_class_name;
		}
		public function set_widget_class_name(string $name){
			$this->widget_class_name				= $name;
			return $this;
		}
		public function get_widget_class_name(): string{
			return $this->widget_class_name;
		}
	}
	
	class sv_widget extends \WP_Widget{
		protected static $sv;
		
		public function set_class($widget){
			static::$sv		 = $widget;
		}
		public function get_class(){
			return static::$sv;
		}
		public function __construct($widget=false){
			if($widget){
				$this->set_class($widget);
			}elseif($this->get_class()){
				parent::__construct(
					$this->get_class()->get_ID(),			// Base ID
					$this->get_class()->get_title(),		// Name
					array(
						'description' => $this->get_class()->get_description()
					)
				);
			}else{
				die('class not defined.'); // @todo: proper error handling
			}
		}
		public function form( $instance ) {
			if ($this->get_class()) {
				if(!$this->get_class()::$scripts_loaded) {
					$this->get_class()->get_root()->acp_style();
					$this->get_class()::$scripts_loaded		= true;
				}

				foreach ($this->get_class()->get_widget_settings() as $setting) {
					echo $setting->widget( ( isset ( $instance[ $setting->get_ID() ] ) ? $instance[ $setting->get_ID() ] : $setting->get_default_value() ), $this );
				}
			}
		}
		public function update($new_instance, $old_instance){
			$instance = array();
			
			foreach ($new_instance as $name => $field) {
				$instance[$name] = (!empty($new_instance[$name])) ? $new_instance[$name] : '';
			}
			
			return $instance;
		}
		public function widget( $args, $instance ) {
			$title = apply_filters( 'widget_title', isset($instance['title']) ? $instance['title'] : '' );
			
			echo $args['before_widget'];
			if ( ! empty( $title ) ) {
				echo $args['before_title'] . $title . $args['after_title'];
			}
			$this->get_class()->get_template($args, $instance);
			echo $args['after_widget'];
		}
	}