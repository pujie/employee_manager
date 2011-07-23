<?php
class Simple_auth_user extends DataMapper{
// var $table = 'simple_auth_user';
var $has_one = array('user');
var $has_many = array('module');
	function __construct(){
		parent::__construct();
	}
}