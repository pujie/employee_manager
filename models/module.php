<?php
class Module extends DataMapper{
	// var $has_many = array('simple_auth_user'=>'simple_auth_users');
	var $has_many = array('simple_auth_user');
	function __construct(){
		parent::__construct();
	}
}