<?php
if ( is_string( $props['value'] ) && ! empty( $props['value'] ) ) {
	$attachment = wp_get_attachment_link( $props['value'], 'full', false, true )
	? wp_get_attachment_link( $props['value'], 'full', false, true ) : false;

	if ( $attachment ) {
		?>
		<div><?php echo $attachment; ?></div>
		<div>
			<a href="/wp-admin/post.php?post=<?php echo $props['value']; ?>&action=edit" target="_blank"><?php echo get_the_title( $props['value'] ); ?></a>
		</div>
<?php
	}
}
?>
<label for="<?php echo $props['ID']; ?>">
	<input
		data-sv_type="sv_form_field"
		class="sv_file"
		id="<?php echo $props['ID']; ?>[file]"
		name="<?php echo ($props['name'] ? $props['name'].'[file]' : ''); ?>"
		type="file"
		<?php echo ((count($this->setting_upload->get_allowed_filetypes()) > 0) ? 'accept="'.implode(',',$this->setting_upload->get_allowed_filetypes()).'"' : ''); ?>
		placeholder="<?php echo $props['placeholder']; ?>"
		<?php echo $props['disabled']; ?>
	/>
</label>
<?php
if( is_string( $props['value'] ) && ! empty( $props['value'] ) ) {
?>
<label for="<?php echo $props['ID']; ?>[delete]" style="justify-content: flex-end;">
	<input
		data-sv_type="sv_form_field"
		id="<?php echo $props['ID']; ?>[delete]"
		name="<?php echo ($props['name'] ? $props['name'].'[delete]' : ''); ?>"
		value="1"
		type="checkbox"
		<?php echo $props['disabled']; ?>
	style="margin-right:16px;"
	/>
	<?php echo __('Delete File', 'sv_core'); ?>
</label>
<?php
}
?>