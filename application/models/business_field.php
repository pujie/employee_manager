<?php
class Business_field extends DataMapper{
	var $has_many	=	array('client');
	function __construct(){
		parent::__construct();
	}
}