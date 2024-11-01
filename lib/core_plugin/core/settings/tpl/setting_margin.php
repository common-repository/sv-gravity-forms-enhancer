<style>
	.sv_setting_margin{
		width:100%;
	}
	.sv_setting_margin td{
		border:1px solid #000;
		min-width:50px;
		height:20px;
		text-align:center;
	}
	.sv_setting_margin td label{
		margin:10px !important;
	}
	.sv_setting_margin td input{
		text-align:center;
	}
</style>

<table class="sv_setting_margin">
	<tr>
		<td colspan="3">
			<?php $this->print_sub_field($props, 'top'); ?>
		</td>
	</tr>
	<tr>
		<td>
			<?php $this->print_sub_field($props, 'left'); ?>
		</td>
		<td style="width:40%;height:100px;">Content</td>
		<td>
			<?php $this->print_sub_field($props, 'right'); ?>
		</td>
	</tr>
	<tr>
		<td colspan="3">
			<?php $this->print_sub_field($props, 'bottom'); ?>
		</td>
	</tr>
</table>