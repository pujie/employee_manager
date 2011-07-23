<?php
class Modules_users extends DataMapper{
var $table = 'modules_users';
var $has_many = array('module','user');
	function __construct(){
		parent::__construct();
	}
}