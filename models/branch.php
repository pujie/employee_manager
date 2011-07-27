<?php
class Branch extends DataMapper{
var $has_many = array('simple_auth_user','client');
	function __construct(){
		parent::__construct();
	}
}