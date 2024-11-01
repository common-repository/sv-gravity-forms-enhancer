<?php
	namespace sv_dependencies;
	
	/**
	 * @author			straightvisions GmbH
	 * @package			sv_100
	 * @copyright	   2019 straightvisions GmbH
	 * @link			https://straightvisions.com
	 * @since			1.0
	 * @license			See license.txt or https://straightvisions.com
	 */
	
	class init {
		private $min_php			= '7.3.0';
		private $instance_name		= '';
		
		public function set_instance_name(string $instance_name): init{
			$this->instance_name			= $instance_name;
			
			return $this;
		}
		public function get_instance_name(): string{
			return $this->instance_name;
		}
		public function set_min_php_version(string $version): init{
			$this->min_php			= $version;
			
			return $this;
		}
		public function get_min_php_version(): string{
			return $this->min_php;
		}
		public function check_php_version(): bool{
			if(version_compare( phpversion(), $this->get_min_php_version(), '>=' )) {
				return true;
			}else{
				return false;
			}
		}
		public function php_update_notification(): init{
			add_action( 'admin_notices', function(){
					echo '<div class="update-nag">';
					echo __( 'You need to update your PHP version to run', 'sv_core' ) . ' ' .$this->get_instance_name()
						 .'<br/>';
					echo __( 'Actual version is:', 'sv_core' ) . '<strong>'.phpversion().'</strong>, ';
					echo __( 'required is', 'sv_core' ) . ' <strong>'.$this->get_min_php_version().'</strong>';
					echo '</div>';
			} );
			
			return $this;
		}
		public function missing_core_notification(): init{
			add_action( 'admin_notices', function(){
				echo '<div class="update-nag">';
				echo __( 'You need to install and activate our SV Core plugin to run', 'sv_core' )
					 . ' ' .$this->get_instance_name().'<br/>';
				echo '</div>';
			} );
			
			return $this;
		}
		public function prevent_theme_activation(): init{
			add_action( 'after_switch_theme', function($oldtheme_name, $oldtheme){
				switch_theme( $oldtheme->stylesheet );
			}, 10, 2 );
			
			return $this;
		}
		public function prevent_plugin_activation(): init{
			add_action('init', function(){
				\deactivate_plugins(plugin_basename( __FILE__ ) );
			});
			
			return $this;
		}
	}
	
	$GLOBALS[ __NAMESPACE__ ] = new init();