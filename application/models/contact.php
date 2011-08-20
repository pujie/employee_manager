<?php
class Contact extends DataMapper{
	var $has_one=array('client');
	function __construct(){
		parent::__construct();
	}
}