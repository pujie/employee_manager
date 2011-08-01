<?php
class Client extends DataMapper{
		var $has_one = array(
		'category','service','branch'
	);
	function __construct(){
		parent::__construct();
	}
}