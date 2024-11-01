<?php
	namespace sv_core;
	
	/**
	 * @author			straightvisions GmbH
	 * @package			sv100
	 * @copyright       2019 straightvisions GmbH
	 * @link			https://straightvisions.com
	 * @since			1.0
	 * @license			See license.txt or https://straightvisions.com
	 */
	
	require_once( 'core/core.php' );
	
	class core_plugin extends core {
		protected static $plugin_core_initialized			= false;
		
		protected function init_subcore(){
			if ( !static::$plugin_core_initialized ) {
				static::$plugin_core_initialized = true;
				
				add_action( 'admin_menu', array( $this, 'admin_menu' ), 1 );
				add_action( 'admin_menu', array( $this, 'section_menus' ), 1 );

				require_once( 'freemius/start.php' );
			}
		}

		public function admin_menu() {
			add_menu_page(
				__( 'straightvisions', 'sv_core' ),
				__( 'straightvisions', 'sv_core' ),
				'manage_options',
				'straightvisions',
				'',
				$this->get_url_core( '../assets/logo_icon.png' ),
				100
			);
			
			add_submenu_page(
				'straightvisions',				// parent slug
				__( 'Info', 'sv_core' ),					// page title
				__( 'Info', 'sv_core' ),					// menu title
				'manage_options',					// capability
				'straightvisions',				// menu slug
				function() {								// callable function
					$this->load_page( $this->get_path_core( 'info/backend/tpl/about.php' ) );
				}
			);
		}

		public function section_menus(){
			foreach ( $this->get_instances() as $name => $instance ) {
				$instance->add_section( $instance );

				add_submenu_page(
					'straightvisions',			// parent slug
					$instance->get_section_title(),			// page title
					$instance->get_section_title(),			// menu title
					'manage_options',				// capability
					$instance->get_prefix(),				// menu slug
					function () use ( $instance ) {			// callable function
						$instance->load_page();
					}
				);
			}
		}

		public function get_module( string $name, bool $required = false ) {
			if($this->is_module_loaded($name)){
				return $this->get_modules_loaded()[$this->get_root()->get_prefix($name)];
			}

			$loaded = $this->get_root()
				->load_module(
					$name,
					$this->get_root()->get_path( 'lib/modules/'.$name ),
					$this->get_root()->get_url( 'lib/modules/'.$name ),
					$required
				);

			if($loaded){
				return $this->get_root()->get_modules_loaded()[$this->get_root()->get_prefix($name) ];
			}

			return false;
		}

		public function load_module( string $name, string $path = 'lib/modules/', string $url = 'lib/modules/', bool $required = false ): bool {
			if($this->is_module_loaded($name)){ // already loaded
				return true;
			}

			$full_path			= $this->get_root()->get_path($path) . $name . '/';
			$full_init_path		= $full_path . $name . '.php';
			$full_url			= $this->get_root()->get_url($url) . $name . '/';

			require_once( $full_init_path );

			$class_name  = $this->get_root()->get_name() . '\\' . $name;
			$this->get_root()->$name = new $class_name();
			$this->get_root()->$name
				->set_name( $this->get_root()->get_prefix( $this->get_root()->$name->get_module_name() ) )
				->set_path( $full_path )
				->set_url( $full_url )
				->set_root( $this->get_root() )
				->set_parent( $this )
				->init();

			$this->set_modules_loaded($this->get_root()->$name->get_prefix(), $this->get_root()->$name);

			return true;
		}
	}