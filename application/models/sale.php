<?php
class Sale extends DataMapper{
	var $has_one=array('user');
	var $has_many=array('client');
	function __construct(){
		parent::__construct();
	}
}