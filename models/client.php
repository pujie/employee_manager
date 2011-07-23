<?php
class Client extends DataMapper{
	var $has_one = array('category'=>array(
							'class'=>'category',
							'join_other_as'=>'category'
						),'service'=>array(
							'class'=>'service',
							'join_other_as'=>'service'
						)
	);
	function __construct(){
		parent::__construct();
	}
}