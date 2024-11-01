<?php if( current_user_can( 'activate_plugins' ) ) { ?>
<section id="section_about" class="sv_admin_section ajax_none">
	<div class="section_head section_about">
		<div class="textbox">
			<h1 class="section_title"><?php _e('About', 'sv_core'); ?></h1>
		</div>
	</div>
	<div class="section_content">
		<div class="col-50">
			<h3 class="divider"><?php _e('Info', 'sv_core'); ?></h3>
			<ul class="info_list">
				<li><?php _e('Name:', 'sv_core'); ?> <span><?php echo $this->get_section_title(); ?></span></li>
				<li><?php _e('Version:', 'sv_core'); ?> <span><?php echo $this->get_version(true); ?></span></li>
			</ul>
		</div>
		<div class="col-50">
			<h3 class="divider"><?php _e('Description', 'sv_core'); ?></h3>
			<p class="instance_description"><?php echo $this->get_section_desc(); ?></p>
		</div>
	</div>
</section>
<?php }