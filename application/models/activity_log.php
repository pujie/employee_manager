<?php
class Activity_log extends DataMapper{
var $has_one	=	array('user');
	function __construct(){
		parent::__construct();
	}
	function add_log($act, $userid){
		$this->act=$act;
		$this->user_id=$userid;
		$this->save();
	}
}