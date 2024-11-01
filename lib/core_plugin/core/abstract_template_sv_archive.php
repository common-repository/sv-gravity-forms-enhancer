<?php
	namespace sv_core;

	// this class could be part of different products
	if(!class_exists('sv_core')) {
		// complete template logic should be here
		class abstract_template_sv_archive{
			protected $path				= '';
			protected $url				= '';

			protected $prefix			= '';

			protected $instance			= false;
			protected $setting_prefix	= '';

			protected $parts			= array();

			public function __construct($instance, string $setting_prefix){
				$this->init($instance, $setting_prefix);
			}
			protected function init($instance, string $setting_prefix): abstract_template_sv_archive{
				$this->parts		= array(
					'common'				=> array(
						'loaded'			=> true,
						'label'				=> __('Common', 'sv_core')
					),
					'entry'					=> array(
						'loaded'			=> true,
						'label'				=> __('Entry', 'sv_core')
					),
					'empty'					=> array(
						'loaded'			=> false,
						'label'				=> __('Empty', 'sv_core')
					),
					'header'				=> array(
						'loaded'			=> false,
						'label'				=> __('Header', 'sv_core')
					),
					'footer'				=> array(
						'loaded'			=> false,
						'label'				=> __('Footer', 'sv_core')
					),
					'sidebar_top'			=> array(
						'loaded'			=> false,
						'label'				=> __('Sidebar Top', 'sv_core')
					),
					'sidebar_right'			=> array(
						'loaded'			=> false,
						'label'				=> __('Sidebar Right', 'sv_core')
					),
					'sidebar_bottom'		=> array(
						'loaded'			=> false,
						'label'				=> __('Sidebar Bottom', 'sv_core')
					),
					'sidebar_left'			=> array(
						'loaded'			=> false,
						'label'				=> __('Sidebar Left', 'sv_core')
					),
					'featured_image'		=> array(
						'loaded'			=> false,
						'label'				=> __('Featured Image', 'sv_core')
					),
					'title'					=> array(
						'loaded'			=> false,
						'label'				=> __('Title', 'sv_core')
					),
					'excerpt'				=> array(
						'loaded'			=> false,
						'label'				=> __('Excerpt', 'sv_core')
					),
					'read_more'				=> array(
						'loaded'			=> false,
						'label'				=> __('Read More', 'sv_core')
					),
					'author'				=> array(
						'loaded'			=> false,
						'label'				=> __('Author', 'sv_core')
					),
					'date'					=> array(
						'loaded'			=> false,
						'label'				=> __('Date', 'sv_core')
					),
					'date_modified'			=> array(
						'loaded'			=> false,
						'label'				=> __('Date Modified', 'sv_core')
					),
					'categories'			=> array(
						'loaded'			=> false,
						'label'				=> __('Categories', 'sv_core')
					)
				);

				$this->set_prefix(get_called_class())->set_instance($instance);

				// templates are always within this path structure: /path-to-instance/path-to-object/lib/template-dir/
				$this->set_path(trailingslashit($this->get_instance()->get_path('lib/'.$this->get_prefix())));
				$this->set_url(trailingslashit($this->get_instance()->get_url('lib/'.$this->get_prefix())));

				// $instance is a SV-instance extending the SV core
				$this->set_setting_prefix($setting_prefix)->load_settings();

				foreach($this->get_parts() as $part => $properties){
					$this->get_script($this->get_prefix($part))
						->set_path($this->get_path('lib/css/common/parts/'.$part.'.css'), true, $this->get_url('lib/css/common/parts/'.$part.'.css'));
				}

				$this->get_script('config')
					->set_path($this->get_path('lib/css/config/init.php'));

				$this->get_script('common')
					->set_path($this->get_path('lib/css/common/parts/common.css'));

				return $this;
			}
			protected function get_instance(){
				return $this->instance;
			}
			protected function set_instance($instance): abstract_template_sv_archive{
				$this->instance	= $instance;

				return $this;
			}
			public function get_setting_prefix( string $suffix = ''): string{
				if( strlen($this->setting_prefix) > 0 && strlen( $suffix ) > 0 ) {
					$suffix = '_' . $suffix;
				}

				return $this->setting_prefix . $suffix;
			}
			protected function set_setting_prefix(string $setting_prefix): abstract_template_sv_archive{
				$this->setting_prefix	= $setting_prefix;

				return $this;
			}
			protected function get_script( string $ID = ''){
				return $this->get_instance()->get_script($this->get_prefix($this->get_setting_prefix($ID)));
			}
			public function get_setting( string $ID = '', string $cluster = ''){
				return $this->get_instance()->get_setting($this->get_setting_prefix($ID), $cluster);
			}
			public function get_settings(){
				return $this->get_instance()->get_settings();
			}
			public function get_parts(): array{
				return $this->parts;
			}
			protected function set_part_loaded(string $part): abstract_template_sv_archive{
				$this->parts[$part]['loaded']	= true;

				return $this;
			}
			protected function set_path( string $path = ''): abstract_template_sv_archive {
				$this->path = $path;

				return $this;
			}
			protected function set_url( string $url = ''): abstract_template_sv_archive {
				$this->url = $url;

				return $this;
			}
			protected function is_child_path(string $suffix): bool{
				$full_path = $this->path . $suffix;

				if(strpos($full_path,'sv100_child') === false){
					return false;
				}

				return true;
			}
			protected function get_path( string $suffix = '', bool $orig = false): string {
				$full_path = $this->path . $suffix;

				// check if path exists
				if(file_exists($full_path)){
					return $full_path;
				}

				// check if child theme path
				if(!$orig && $this->is_child_path($suffix)){
					// does not exist, try parent theme
					return str_replace('sv100_child', 'sv100', $full_path);
				}

				return '';
			}
			protected function get_url( string $suffix = ''): string {
				$full_url = $this->url . $suffix;

				// check if path exists
				if(file_exists($this->get_path($suffix, true))){
					return $full_url;
				}

				// check if child theme path
				if($this->is_child_path($suffix)){
					// does not exist, try parent theme
					return str_replace('sv100_child', 'sv100', $full_url);
				}

				return '';
			}
			protected function set_prefix( string $prefix = ''): abstract_template_sv_archive{
				$this->prefix	= $prefix;

				return $this;
			}
			protected function get_prefix( string $suffix = ''): string {
				if( strlen( $suffix ) > 0 ) {
					$suffix = '_' . $suffix;
				}

				return $this->prefix . $suffix;
			}
			protected function get_post_class( $class = '', $post_id = null ): string{
				// Separates classes with a single space, collates classes for post DIV.
				return 'class="'. $this->get_prefix('entry') . ' ' . esc_attr( implode( ' ', get_post_class( $class, $post_id ) ) ) . '"';
			}
			protected function get_html(){
				global $wp_query;

				ob_start();
				require($this->get_path('lib/tpl/frontend/loop.php'));
				return ob_get_clean();
			}
			public function get_output(): string{
				$output = $this->get_html();

				// register styles for each part in use
				foreach($this->get_parts() as $part => $properties){
					if($properties['loaded'] === true){
						$this->get_script($this->get_prefix($part))->set_is_enqueued();
					}
				}

				$script		= $this->get_script('config')
					->set_path(
						$this->get_instance()->get_path_cached($this->get_prefix().'/'.$this->get_setting_prefix().'/frontend.css'),
						true,
						$this->get_instance()->get_url_cached($this->get_prefix().'/'.$this->get_setting_prefix().'/frontend.css')
					)
					->set_is_enqueued();

				add_action( 'wp_footer', function() use($script) {
					$this->cache_config_css($script);
				}, 2 );

				return $output;
			}
			protected function get_part(string $part): string{
				if(boolval($this->get_setting('show_'.$part)->get_data()) !== true){
					return '';
				}

				$this->set_part_loaded($part);

				ob_start();
				require($this->get_path('lib/tpl/frontend/parts/'.$part.'.php'));
				$output = ob_get_clean();

				if(strlen($output) === 0){
					return '';
				}

				return '<div class="'.$this->get_prefix($part).'">'.$output.'</div>';
			}
			// We want to serve cached CSS depending on active configuration
			protected function cache_config_css(\sv_core\scripts $script): abstract_template_sv_archive{
				if ($script->get_css_cache_invalidated()) {
					ob_start();
					require($this->get_path('lib/css/config/init.php'));
					$css = ob_get_clean();

					file_put_contents($this->get_instance()->get_path_cached($this->get_prefix() . '/' . $this->get_setting_prefix() . '/frontend.css'), $css);

					$script->set_css_cache_invalidated(false);
				}
				return $this;
			}
			protected function load_settings(): abstract_template_sv_archive{
				// logic comes from child
				
				return $this;
			}
			protected function load_settings_extra_styles(): abstract_template_sv_archive{
				$this->get_instance()->get_setting( 'extra_styles' )
					->set_title( __( 'Extra Styles', 'abstract_template_sv_archive' ) )
					->load_type( 'group' );

				$this->get_instance()->get_setting( 'extra_styles' )
					->run_type()
					->add_child()
					->set_ID( 'entry_label' )
					->set_title( __( 'Style Label', 'abstract_template_sv_archive' ) )
					->set_description( __( 'A label to differentiate your Styles.', 'abstract_template_sv_archive' ) )
					->load_type( 'text' )
					->set_placeholder( __( 'Label', 'abstract_template_sv_archive' ) );

				$this->get_instance()->get_setting( 'extra_styles' )
					->run_type()
					->add_child()
					->set_ID( 'slug' )
					->set_title( __( 'Slug', 'abstract_template_sv_archive' ) )
					->set_description( __( 'This slug is used for the helper classes.', 'abstract_template_sv_archive' ) )
					->load_type( 'text' );

				foreach($this->get_settings() as $setting) {
					if(strpos($setting->get_ID(), 'extra_styles') !== false) {
						continue;
					}
					if(strpos($setting->get_ID(), 'archive_') !== 0) {
						continue;
					}
					if($setting->get_ID() != 'extra_styles') {
						$this->get_instance()->get_setting( 'extra_styles' )
							->run_type()
							->add_child($setting);
					}
				}

				return $this;
			}
			protected function load_settings_common(): abstract_template_sv_archive{
				$this->get_setting( 'header_min_height', __('Common', 'sv_core') )
					->set_title( __( 'Min Height', 'abstract_template_sv_archive' ) )
					->set_description( __( 'Minimum Height Header', 'abstract_template_sv_archive' ) )
					->set_is_responsive(true)
					->set_default_value('60vh')
					->load_type( 'text' );

				$this->get_setting( 'stack_active', __('Common', 'sv_core') )
					->set_title( __( 'Stack Sidebar Columns', 'abstract_template_sv_archive' ) )
					->set_description( __( 'You may want to stack Sidebars on narrow viewports.', 'abstract_template_sv_archive' ) )
					->set_is_responsive(true)
					->set_default_value(array(
						'mobile'						=> 1,
						'mobile_landscape'				=> 1,
						'tablet'						=> 1,
						'tablet_landscape'				=> 0,
						'tablet_pro'					=> 0,
						'tablet_pro_landscape'			=> 0,
						'desktop'						=> 0
					))
					->load_type( 'checkbox' );

				$this->get_setting('columns', __('Common', 'sv_core'))
					->set_title( __( 'Columns', 'abstract_template_sv_archive' ) )
					->set_description( __( 'Set number of columns for entries', 'abstract_template_sv_archive' ) )
					->set_is_responsive(true)
					->set_default_value(array(
						'mobile'						=> 1,
						'mobile_landscape'				=> 2,
						'tablet'						=> 2,
						'tablet_landscape'				=> 2,
						'tablet_pro'					=> 2,
						'tablet_pro_landscape'			=> 2,
						'desktop'						=> 2
					))
					->load_type( 'number' );

				$this->get_setting( 'font', __('Common', 'sv_core') )
					->set_title( __( 'Font Family', 'abstract_template_sv_archive' ) )
					->set_description( __( 'Choose a font for your text.', 'abstract_template_sv_archive' ) )
					->set_options( $this->get_instance()->get_module( 'sv_webfontloader' ) ? $this->get_instance()->get_module( 'sv_webfontloader' )->get_font_options() : array('' => __('Please activate module SV Webfontloader for this Feature.', 'sv_core')) )
					->set_is_responsive(true)
					->load_type( 'select' );

				$this->get_setting( 'font_size', __('Common', 'sv_core') )
					->set_title( __( 'Font Size', 'abstract_template_sv_archive' ) )
					->set_description( __( 'Font Size in Pixel', 'abstract_template_sv_archive' ) )
					->set_is_responsive(true)
					->load_type( 'number' );

				$this->get_setting( 'line_height', __('Common', 'sv_core') )
					->set_title( __( 'Line Height', 'abstract_template_sv_archive' ) )
					->set_description( __( 'Set line height as multiplier or with a unit.', 'abstract_template_sv_archive' ) )
					->set_is_responsive(true)
					->load_type( 'text' );

				$this->get_setting( 'text_color', __('Common', 'sv_core') )
					->set_title( __( 'Text Color', 'abstract_template_sv_archive' ) )
					->set_is_responsive(true)
					->load_type( 'color' );

				$this->get_setting( 'bg_color', __('Common', 'sv_core') )
					->set_title( __( 'Background Color', 'abstract_template_sv_archive' ) )
					->set_is_responsive(true)
					->load_type( 'color' );

				$this->get_setting( 'column_spacing', __('Common', 'sv_core') )
					->set_title( __( 'Column Spacing', 'abstract_template_sv_archive' ) )
					->set_description( __( 'Set a Spacing in Pixel for columns', 'abstract_template_sv_archive' ) )
					->set_default_value(10)
					->load_type( 'text' );

				$this->get_setting( 'margin', __('Common', 'sv_core') )
					->set_title( __( 'Margin', 'abstract_template_sv_archive' ) )
					->set_is_responsive(true)
					->set_default_value(
						array(
							'top'		=> '0',
							'right'		=> 'auto',
							'bottom'	=> '0',
							'left'		=> 'auto'
						)
					)
					->load_type( 'margin' );

				$this->get_setting( 'padding', __('Common', 'sv_core') )
					->set_title( __( 'Padding', 'abstract_template_sv_archive' ) )
					->set_is_responsive(true)
					->set_default_value(
						array(
							'top'		=> '0',
							'right'		=> '22px',
							'bottom'	=> '0',
							'left'		=> '22px'
						)
					)
					->load_type( 'margin' );

				$this->get_setting( 'border', __('Common', 'sv_core') )
					->set_title( __( 'Border', 'abstract_template_sv_archive' ) )
					->set_is_responsive(true)
					->load_type( 'border' );

				return $this;
			}
			protected function load_settings_entry(): abstract_template_sv_archive{
				$this->get_setting( 'entry_bg_color', __('Entry', 'sv_core') )
					->set_title( __( 'Background Color', 'abstract_template_sv_archive' ) )
					->set_is_responsive(true)
					->load_type( 'color' );

				$this->get_setting( 'entry_margin', __('Entry', 'sv_core') )
					->set_title( __( 'Margin', 'abstract_template_sv_archive' ) )
					->set_is_responsive(true)
					->set_default_value(
						array(
							'top'		=> '0',
							'right'		=> '0',
							'bottom'	=> '40px',
							'left'		=> '0'
						)
					)
					->load_type( 'margin' );

				$this->get_setting( 'entry_padding', __('Entry', 'sv_core') )
					->set_title( __( 'Padding', 'abstract_template_sv_archive' ) )
					->set_is_responsive(true)
					->load_type( 'margin' );

				$this->get_setting( 'entry_border', __('Entry', 'sv_core') )
					->set_title( __( 'Border', 'abstract_template_sv_archive' ) )
					->set_is_responsive(true)
					->load_type( 'border' );

				return $this;
			}
			protected function load_settings_parts(): abstract_template_sv_archive{
				$this->get_setting('show_header', __('Parts', 'sv_core'))
					->set_title( __( 'Show Archive Header', 'abstract_template_sv_archive' ) )
					->set_description( __( 'Show or Hide this Template Part', 'abstract_template_sv_archive' ) )
					->set_default_value(1)
					->load_type( 'checkbox' );

				$this->get_setting('show_footer', __('Parts', 'sv_core'))
					->set_title( __( 'Show Archive Footer', 'abstract_template_sv_archive' ) )
					->set_description( __( 'Show or Hide this Template Part', 'abstract_template_sv_archive' ) )
					->set_default_value(1)
					->load_type( 'checkbox' );

				$this->get_setting('show_empty', __('Parts', 'sv_core'))
					->set_title( __( 'Show Notice when empty', 'abstract_template_sv_archive' ) )
					->set_description( __( 'Show or Hide this Template Part', 'abstract_template_sv_archive' ) )
					->set_default_value(1)
					->load_type( 'checkbox' );

				$this->get_setting('show_featured_image', __('Parts', 'sv_core'))
					->set_title( __( 'Show Featured Image', 'abstract_template_sv_archive' ) )
					->set_description( __( 'Show or Hide this Template Part', 'abstract_template_sv_archive' ) )
					->set_default_value(1)
					->load_type( 'checkbox' );

				$this->get_setting('show_title', __('Parts', 'sv_core'))
					->set_title( __( 'Show Title', 'abstract_template_sv_archive' ) )
					->set_description( __( 'Show or Hide this Template Part', 'abstract_template_sv_archive' ) )
					->set_default_value(1)
					->load_type( 'checkbox' );

				$this->get_setting('show_excerpt', __('Parts', 'sv_core'))
					->set_title( __( 'Show Excerpt', 'abstract_template_sv_archive' ) )
					->set_description( __( 'Show or Hide this Template Part', 'abstract_template_sv_archive' ) )
					->set_default_value(1)
					->load_type( 'checkbox' );

				$this->get_setting('show_read_more', __('Parts', 'sv_core'))
					->set_title( __( 'Show Read More', 'abstract_template_sv_archive' ) )
					->set_description( __( 'Show or Hide this Template Part', 'abstract_template_sv_archive' ) )
					->set_default_value(1)
					->load_type( 'checkbox' );

				$this->get_setting('show_author', __('Parts', 'template_sv_archive_pba_default'))
					->set_title( __( 'Show Author', 'template_sv_archive_pba_default' ) )
					->set_description( __( 'Show or Hide this Template Part', 'template_sv_archive_pba_default' ) )
					->set_default_value(1)
					->load_type( 'checkbox' );

				$this->get_setting('show_date', __('Parts', 'sv_core'))
					->set_title( __( 'Show Date', 'abstract_template_sv_archive' ) )
					->set_description( __( 'Show or Hide this Template Part', 'abstract_template_sv_archive' ) )
					->set_default_value(1)
					->load_type( 'checkbox' );

				$this->get_setting('show_date_modified', __('Parts', 'sv_core'))
					->set_title( __( 'Show Date Modified', 'abstract_template_sv_archive' ) )
					->set_description( __( 'Show or Hide this Template Part', 'abstract_template_sv_archive' ) )
					->set_default_value(0)
					->load_type( 'checkbox' );

				$this->get_setting('show_categories', __('Parts', 'sv_core'))
					->set_title( __( 'Show Categories', 'abstract_template_sv_archive' ) )
					->set_description( __( 'Show or Hide this Template Part', 'abstract_template_sv_archive' ) )
					->set_default_value(1)
					->load_type( 'checkbox' );

				return $this;
			}
			protected function load_settings_part(string $part): abstract_template_sv_archive{
				$this->get_setting( $part.'_order', $part )
					->set_title( __( 'Order', 'abstract_template_sv_archive' ) )
					->set_description( __( 'Order part', 'abstract_template_sv_archive' ) )
					->set_options(
						array('' => __('Default', 'sv_core'))
						+array_combine(
							range(1, count($this->get_parts())),
							range(1, count($this->get_parts()))
						)
					)
					->set_is_responsive(true)
					->load_type( 'select' );

				$this->get_setting( $part.'_font', $part )
					->set_title( __( 'Font Family', 'abstract_template_sv_archive' ) )
					->set_description( __( 'Choose a font for your text.', 'abstract_template_sv_archive' ) )
					->set_options( $this->get_instance()->get_module( 'sv_webfontloader' ) ? $this->get_instance()->get_module( 'sv_webfontloader' )->get_font_options() : array('' => __('Please activate module SV Webfontloader for this Feature.', 'sv_core')) )
					->set_is_responsive(true)
					->load_type( 'select' );

				$this->get_setting( $part.'_font_size', $part )
					->set_title( __( 'Font Size', 'abstract_template_sv_archive' ) )
					->set_description( __( 'Font Size in Pixel', 'abstract_template_sv_archive' ) )
					->set_is_responsive(true)
					->load_type( 'number' );

				$this->get_setting( $part.'_line_height', $part )
					->set_title( __( 'Line Height', 'abstract_template_sv_archive' ) )
					->set_description( __( 'Set line height as multiplier or with a unit.', 'abstract_template_sv_archive' ) )
					->set_is_responsive(true)
					->load_type( 'text' );

				$this->get_setting( $part.'_text_color', $part )
					->set_title( __( 'Text Color', 'abstract_template_sv_archive' ) )
					->set_is_responsive(true)
					->load_type( 'color' );

				$this->get_setting( $part.'_bg_color', $part )
					->set_title( __( 'Background Color', 'abstract_template_sv_archive' ) )
					->set_is_responsive(true)
					->load_type( 'color' );

				$this->get_setting( $part.'_text_color_hover', $part )
					->set_title( __( 'Text Color Hover', 'abstract_template_sv_archive' ) )
					->set_is_responsive(true)
					->load_type( 'color' );

				$this->get_setting( $part.'_bg_color_hover', $part )
					->set_title( __( 'Background Color Hover', 'abstract_template_sv_archive' ) )
					->set_is_responsive(true)
					->load_type( 'color' );

				$this->get_setting( $part.'_margin', $part )
					->set_title( __( 'Margin', 'abstract_template_sv_archive' ) )
					->set_is_responsive(true)
					->load_type( 'margin' );

				$this->get_setting( $part.'_padding', $part )
					->set_title( __( 'Padding', 'abstract_template_sv_archive' ) )
					->set_is_responsive(true)
					->load_type( 'margin' );

				$this->get_setting( $part.'_border', $part )
					->set_title( __( 'Border', 'abstract_template_sv_archive' ) )
					->set_is_responsive(true)
					->load_type( 'border' );

				$this->load_settings_part_default_values($part);

				return $this;
			}
			protected function load_settings_part_default_values(string $part): abstract_template_sv_archive{
				if(
					$part == 'featured_image'
					|| $part == 'title'
					|| $part == 'excerpt'
				){
					$this->get_setting( $part.'_margin', $part )->set_default_value(
						array(
							'top'		=> '0',
							'right'		=> '0',
							'bottom'	=> '20px',
							'left'		=> '0'
						)
					);
				}

				if($part == 'title'){
					$this->get_setting( $part.'_font_size', $part )->set_default_value(20);
				}

				if(
					$part == 'read_more'
				){
					$this->get_setting( $part.'_padding', $part )->set_default_value(
						array(
							'top'		=> '0',
							'right'		=> '10px',
							'bottom'	=> '0',
							'left'		=> '0'
						)
					);
				}

				if(
					$part == 'date'
				){
					$this->get_setting( $part.'_padding', $part )->set_default_value(
						array(
							'top'		=> '0',
							'right'		=> '10px',
							'bottom'	=> '0',
							'left'		=> '10px'
						)
					);
				}

				if(
					$part == 'categories'
				){
					$this->get_setting( $part.'_padding', $part )->set_default_value(
						array(
							'top'		=> '0',
							'right'		=> '0',
							'bottom'	=> '0',
							'left'		=> '10px'
						)
					);
				}

				return $this;
			}
			protected function get_sidebar(string $position): string{
				if(!$this->get_instance()->get_module( 'sv_sidebar' )){
					return '';
				}
				if(strlen($this->get_instance()->get_active_archive_type()) === 0){
					return '';
				}

				return $this->get_instance()->get_module( 'sv_sidebar' )->load(
					$this->get_setting( 'show_sidebar_'.$position )->get_data()
				);
			}
			protected function has_sidebar(string $position): string{
				if(!$this->get_setting('show_sidebar_'.$position)->get_data()){
					return false;
				}

				if(strlen($this->get_sidebar($position)) === 0){
					return false;
				}

				return true;
			}
		}
	}