<?php
namespace sv_core;

class setting_id extends settings {
	private $parent	= false;

	/**
	 * @desc			initialize
	 * @author			Matthias Bathke
	 * @since			1.0
	 * @ignore
	 */
	public function __construct($parent=false){
		$this->parent = $parent;
	}
	public function sanitize($meta_value){
		return sanitize_title($meta_value);
	}
}