<?php 
	if( current_user_can( 'activate_plugins' ) ) { 

	$icon_plugin = '<svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="plug" class="svg-inline--fa fa-plug fa-w-12" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512"><path fill="currentColor" d="M320,32a32,32,0,0,0-64,0v96h64Zm48,128H16A16,16,0,0,0,0,176v32a16,16,0,0,0,16,16H32v32A160.07,160.07,0,0,0,160,412.8V512h64V412.8A160.07,160.07,0,0,0,352,256V224h16a16,16,0,0,0,16-16V176A16,16,0,0,0,368,160ZM128,32a32,32,0,0,0-64,0v96h64Z"></path></svg>';
	$icon_theme = '<svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="brush" class="svg-inline--fa fa-brush fa-w-12" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512"><path fill="currentColor" d="M352 0H32C14.33 0 0 14.33 0 32v224h384V32c0-17.67-14.33-32-32-32zM0 320c0 35.35 28.66 64 64 64h64v64c0 35.35 28.66 64 64 64s64-28.65 64-64v-64h64c35.34 0 64-28.65 64-64v-32H0v32zm192 104c13.25 0 24 10.74 24 24 0 13.25-10.75 24-24 24s-24-10.75-24-24c0-13.26 10.75-24 24-24z"></path></svg>';
	$icon_type = '<svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="box" class="svg-inline--fa fa-box fa-w-16" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path fill="currentColor" d="M509.5 184.6L458.9 32.8C452.4 13.2 434.1 0 413.4 0H272v192h238.7c-.4-2.5-.4-5-1.2-7.4zM240 0H98.6c-20.7 0-39 13.2-45.5 32.8L2.5 184.6c-.8 2.4-.8 4.9-1.2 7.4H240V0zM0 224v240c0 26.5 21.5 48 48 48h416c26.5 0 48-21.5 48-48V224H0z"></path></svg>';
	$icon_version = '<svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="rocket" class="svg-inline--fa fa-rocket fa-w-16" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path fill="currentColor" d="M505.12019,19.09375c-1.18945-5.53125-6.65819-11-12.207-12.1875C460.716,0,435.507,0,410.40747,0,307.17523,0,245.26909,55.20312,199.05238,128H94.83772c-16.34763.01562-35.55658,11.875-42.88664,26.48438L2.51562,253.29688A28.4,28.4,0,0,0,0,264a24.00867,24.00867,0,0,0,24.00582,24H127.81618l-22.47457,22.46875c-11.36521,11.36133-12.99607,32.25781,0,45.25L156.24582,406.625c11.15623,11.1875,32.15619,13.15625,45.27726,0l22.47457-22.46875V488a24.00867,24.00867,0,0,0,24.00581,24,28.55934,28.55934,0,0,0,10.707-2.51562l98.72834-49.39063c14.62888-7.29687,26.50776-26.5,26.50776-42.85937V312.79688c72.59753-46.3125,128.03493-108.40626,128.03493-211.09376C512.07526,76.5,512.07526,51.29688,505.12019,19.09375ZM384.04033,168A40,40,0,1,1,424.05,128,40.02322,40.02322,0,0,1,384.04033,168Z"></path></svg>';
	$icon_core = '<svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="atom" class="svg-inline--fa fa-atom fa-w-14" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path fill="currentColor" d="M223.99908,224a32,32,0,1,0,32.00782,32A32.06431,32.06431,0,0,0,223.99908,224Zm214.172-96c-10.877-19.5-40.50979-50.75-116.27544-41.875C300.39168,34.875,267.63386,0,223.99908,0s-76.39066,34.875-97.89653,86.125C50.3369,77.375,20.706,108.5,9.82907,128-6.54984,157.375-5.17484,201.125,34.958,256-5.17484,310.875-6.54984,354.625,9.82907,384c29.13087,52.375,101.64652,43.625,116.27348,41.875C147.60842,477.125,180.36429,512,223.99908,512s76.3926-34.875,97.89652-86.125c14.62891,1.75,87.14456,10.5,116.27544-41.875C454.55,354.625,453.175,310.875,413.04017,256,453.175,201.125,454.55,157.375,438.171,128ZM63.33886,352c-4-7.25-.125-24.75,15.00391-48.25,6.87695,6.5,14.12891,12.875,21.88087,19.125,1.625,13.75,4,27.125,6.75,40.125C82.34472,363.875,67.09081,358.625,63.33886,352Zm36.88478-162.875c-7.752,6.25-15.00392,12.625-21.88087,19.125-15.12891-23.5-19.00392-41-15.00391-48.25,3.377-6.125,16.37891-11.5,37.88478-11.5,1.75,0,3.875.375,5.75.375C104.09864,162.25,101.84864,175.625,100.22364,189.125ZM223.99908,64c9.50195,0,22.25586,13.5,33.88282,37.25-11.252,3.75-22.50391,8-33.88282,12.875-11.377-4.875-22.62892-9.125-33.88283-12.875C201.74516,77.5,214.49712,64,223.99908,64Zm0,384c-9.502,0-22.25392-13.5-33.88283-37.25,11.25391-3.75,22.50587-8,33.88283-12.875C235.378,402.75,246.62994,407,257.8819,410.75,246.25494,434.5,233.501,448,223.99908,448Zm0-112a80,80,0,1,1,80-80A80.00023,80.00023,0,0,1,223.99908,336ZM384.6593,352c-3.625,6.625-19.00392,11.875-43.63479,11,2.752-13,5.127-26.375,6.752-40.125,7.75195-6.25,15.00391-12.625,21.87891-19.125C384.7843,327.25,388.6593,344.75,384.6593,352ZM369.65538,208.25c-6.875-6.5-14.127-12.875-21.87891-19.125-1.625-13.5-3.875-26.875-6.752-40.25,1.875,0,4.002-.375,5.752-.375,21.50391,0,34.50782,5.375,37.88283,11.5C388.6593,167.25,384.7843,184.75,369.65538,208.25Z"></path></svg>';
	$icon_match = '<svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="handshake" class="svg-inline--fa fa-handshake fa-w-20" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512"><path fill="currentColor" d="M434.7 64h-85.9c-8 0-15.7 3-21.6 8.4l-98.3 90c-.1.1-.2.3-.3.4-16.6 15.6-16.3 40.5-2.1 56 12.7 13.9 39.4 17.6 56.1 2.7.1-.1.3-.1.4-.2l79.9-73.2c6.5-5.9 16.7-5.5 22.6 1 6 6.5 5.5 16.6-1 22.6l-26.1 23.9L504 313.8c2.9 2.4 5.5 5 7.9 7.7V128l-54.6-54.6c-5.9-6-14.1-9.4-22.6-9.4zM544 128.2v223.9c0 17.7 14.3 32 32 32h64V128.2h-96zm48 223.9c-8.8 0-16-7.2-16-16s7.2-16 16-16 16 7.2 16 16-7.2 16-16 16zM0 384h64c17.7 0 32-14.3 32-32V128.2H0V384zm48-63.9c8.8 0 16 7.2 16 16s-7.2 16-16 16-16-7.2-16-16c0-8.9 7.2-16 16-16zm435.9 18.6L334.6 217.5l-30 27.5c-29.7 27.1-75.2 24.5-101.7-4.4-26.9-29.4-24.8-74.9 4.4-101.7L289.1 64h-83.8c-8.5 0-16.6 3.4-22.6 9.4L128 128v223.9h18.3l90.5 81.9c27.4 22.3 67.7 18.1 90-9.3l.2-.2 17.9 15.5c15.9 13 39.4 10.5 52.3-5.4l31.4-38.6 5.4 4.4c13.7 11.1 33.9 9.1 45-4.7l9.5-11.7c11.2-13.8 9.1-33.9-4.6-45.1z"></path></svg>';
	$icon_active = '<svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="check" class="svg-inline--fa fa-check fa-w-16" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path fill="currentColor" d="M173.898 439.404l-166.4-166.4c-9.997-9.997-9.997-26.206 0-36.204l36.203-36.204c9.997-9.998 26.207-9.998 36.204 0L192 312.69 432.095 72.596c9.997-9.997 26.207-9.997 36.204 0l36.203 36.204c9.997 9.997 9.997 26.206 0 36.204l-294.4 294.401c-9.998 9.997-26.207 9.997-36.204-.001z"></path></svg>';
	$icon_inactive = '<svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="times" class="svg-inline--fa fa-times fa-w-11" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 352 512"><path fill="currentColor" d="M242.72 256l100.07-100.07c12.28-12.28 12.28-32.19 0-44.48l-22.24-22.24c-12.28-12.28-32.19-12.28-44.48 0L176 189.28 75.93 89.21c-12.28-12.28-32.19-12.28-44.48 0L9.21 111.45c-12.28 12.28-12.28 32.19 0 44.48L109.28 256 9.21 356.07c-12.28 12.28-12.28 32.19 0 44.48l22.24 22.24c12.28 12.28 32.2 12.28 44.48 0L176 322.72l100.07 100.07c12.28 12.28 32.2 12.28 44.48 0l22.24-22.24c12.28-12.28 12.28-32.19 0-44.48L242.72 256z"></path></svg>';
	?>
	<section id="section_about" class="sv_admin_section ajax_none">
		<div class="section_head section_about ajax_none">
			<div class="textbox">
				<h1 class="section_title"><?php _e( 'About', 'sv_core' ); ?></h1>
			</div>
		</div>
		<div class="section_content">
			<div class="col-50">
				<h3 class="divider"><?php _e( 'Info', 'sv_core' ); ?></h3>
				<ul class="info_list">
					<li>
						<?php _e('Name:', 'sv_core'); ?>
						<span><?php echo get_admin_page_title(); ?></span>
					</li>
					<li>
						<?php _e('Active Core Version:', 'sv_core'); ?>
						<span><?php echo $this->get_version_core(true); ?></span>
					</li>
					<li>
						<?php _e('Active Core Path:', 'sv_core'); ?>
						<span><?php echo $this->get_path_core(); ?></span>
					</li>
				</ul>
			</div>
			<div class="col-50">
				<h3 class="divider"><?php _e('Description', 'sv_core'); ?></h3>
				<p class="instance_description">
				<?php
				_e(
				'Our themes and plugins share a core which provides commonly used features.
					The core is included and shared within each plugin or theme, so make sure if you update one product,
					to update all others too.'
					, 'sv_core'
				);
				?>
				</p>
			</div>
			<div class="col-50">
				<h3 class="divider"><?php _e('Primary Instance', 'sv_core'); ?></h3>
				<a href="/wp-admin/<?php echo ($this->is_theme_instance() ? 'themes' : 'admin'); ?>
				.php?page=<?php echo $this->get_name() ?>"><?php echo $this->get_section_title(); ?></a>
			</div>

			<div class="col-50">
				<form id="<?php echo 'sv_core_expert_mode'; ?>" method="POST">
					<?php
						// @todo Add description to describe what expert mode does
						echo $this->get_setting()
							->set_ID('sv_expert_mode')
							->set_title( __('Expert Mode', 'sv_core'))
							->set_is_no_prefix()
							->load_type('checkbox')
							->set_data(get_user_meta(get_current_user_id(), 'sv_core_expert_mode', true))
							->form();
					?>
				</form>
			</div>
			<div>
				<h3 class="divider"><?php _e('Instances', 'sv_core'); ?></h3>
				<ul class="instance_list">
				<?php
					foreach( $this->get_instances() as $name => $instance ) {
						if($this->is_instance_active($instance->get_name())) {
							$instance_msg = '';
						} else {
							$instance_msg = __('This plugin version is outdated, please update this plugin!', 'sv_core');
						}
				?>
				<a href="/wp-admin/<?php echo ($instance->is_theme_instance() ? 'themes' : 'admin'); ?>.php?page=<?php echo $instance->get_name() ?>"
					class="instance <?php echo (($this->is_instance_active($instance->get_name())) ? '' : ' disabled'); ?>">
					<h1 class="instance_title
						<?php
						echo $instance->is_theme_instance()
							? 'instance_theme'
							: 'instance_plugin';
						?>">
						<i class="icon_title"><?php echo $instance->is_theme_instance() ? $icon_theme : $icon_plugin; ?></i>
						<?php echo $instance->get_section_title(); ?>
					</h1>
					<p class="instance_desc"><?php echo $instance->get_section_desc(); ?></p>
					<div class="instance_type">
						<i class="icon_type"><?php echo $icon_type; ?></i>
						<?php echo $instance->is_theme_instance() ? __('Theme', 'sv_core') : __('Plugin', 'sv_core'); ?>
					</div>
					<div class="instance_version">
						<i class="icon_version"><?php echo $icon_version; ?></i>
						v<?php echo $instance->get_version( true ); ?>
					</div>
					<div class="instance_version_core">
						<i class="icon_core"><?php echo $icon_core; ?></i>	
						v<?php echo $instance->get_version_core( true ); ?>
					</div>
					<div class="instance_version_core_match">
						<i class="icon_core"><?php echo $icon_match; ?></i>
						v<?php echo $instance->get_version_core_match( true ); ?>
					</div>
					<div class="instance_status">
						<i class="icon_status"><?php echo $this->is_instance_active( $instance->get_name() ) ? $icon_active : $icon_unactive; ?></i>
						<?php
						echo (($this->is_instance_active($instance->get_name()))
							? __('Active', 'sv_core')
							: __('Disabled', 'sv_core'));
						?>
					</div>
					<div class="instance_msg"><?php echo $instance_msg; ?></div>
				</a>
				<?php } ?>
				</ul>
			</div>
		</div>
	</section>
<?php }