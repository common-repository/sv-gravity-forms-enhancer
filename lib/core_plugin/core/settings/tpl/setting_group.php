<?php echo $this->run_type()->add_group_html(); ?>
<?php echo $this->run_type()->group_draft_html( $this->get_field_id() ); ?>
<div class="sv_<?php echo $this->run_type()->get_module_name(); ?>_wrapper">
	<input type="hidden" name="<?php echo $this->get_field_id(); ?>" value="" />
	<?php
		$i = 0;

		if($this->run_type()->get_children() && get_option($this->get_field_id())) {
			foreach (get_option($this->get_field_id()) as $setting_id => $setting) {
				echo $this->run_type()->html_field($i,intval($setting_id),$this->get_field_id());
				$i++;
			}
		}
	?>
</div>
<?php echo $this->run_type()->add_group_html(); ?>