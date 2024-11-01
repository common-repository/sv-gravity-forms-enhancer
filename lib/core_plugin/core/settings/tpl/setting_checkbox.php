<?php

if($this->has_options()) {
	foreach ( $this->get_options() as $o_value => $o_name ) {

		$new_ID = $new_name = $props['name'].'['.$o_value.']';

		$new_props			= $props;
		$new_props['ID']	= $new_ID;
		$new_props['title']	= $o_name;
		$new_props['name']	= $new_ID;

		if(count($this->get_options()) > 0){
			echo $new_props['title'];
		}

		$this->print_sub_field($new_props, $o_value);
	}
}else{
	$this->print_sub_field($props, $props['name']);
}
?>