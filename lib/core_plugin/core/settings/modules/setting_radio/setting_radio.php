<?php

namespace sv_core;

class setting_radio extends settings{
	private $parent				= false;

	/**
	 * @desc			initialize
	 * @author			Matthias Bathke
	 * @since			1.0
	 * @ignore
	 */
	public function __construct($parent=false){
		$this->parent			= $parent;
	}

	public function get($value,$format,$object){
		return $this->$format($value,$object);
	}
}