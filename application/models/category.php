<?php
class Category extends DataMapper{
	var $has_many = array('client'=>array(
						'class'=>'client',
						'join_other_as'=>'client'
	));
	function __construct(){
		parent::__construct();
	}
}