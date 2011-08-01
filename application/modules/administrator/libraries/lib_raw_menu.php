<?php
class Lib_raw_menu{
var $obj;
	function __construct(){
		$this->obj = & get_instance();
	}
	function create_menu($menu){
		return $this->obj->lib_table_manager->create_table($menu);;
	}
}