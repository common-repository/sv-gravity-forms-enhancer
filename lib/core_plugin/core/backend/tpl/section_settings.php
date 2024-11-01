<?php if( current_user_can( 'activate_plugins' ) ) { ?>
<section id="section_<?php echo $section_name; ?>" class="sv_admin_section">
	<div class="section_head section_settings">
		<div class="textbox">
			<h1 class="section_title"><?php echo $section['object']->get_section_title(); ?></h1>
		</div>
	</div>
	<div class="section_content">
	<?php echo $this->get_root()::$settings->get_module_settings_form($section['object']); ?>
	</div>
</section>
<?php }