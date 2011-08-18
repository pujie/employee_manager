<?php
class Department extends DataMapper{
var $has_many=array('user');
	function __construct(){
		parent::__construct();
	}
}