<?php
class Simple_auth_user extends DataMapper{
	var $has_one = array('user');
	var $has_many = array('module','branch');
	function __construct(){
		parent::__construct();
	}

	function get_user_list(){
		$list=array();
		$this->get();
		foreach($this as $user){
			array_push($list,array($user->id,
				$user->username,$user->email,
				anchor('simple_auth_users/edit/' . $user->id,'Edit'),
				anchor('simple_auth_users/delete/' . $user->id,'Delete'),
				anchor('simple_auth_users/show_modules/' . $user->id,'Modules'),
				anchor('simple_auth_users/show_branches/' . $user->id,'Branches')));
		}
		return $list;
	}
	
	function get_user_count(){
		return $this->count();
	}
	
	function get_modules_list(){
		$list	=	array();
		$this->get();
		foreach($this->module as $module){
			array_push($list,array($module->id,
				$module->name));
		}
		return $list;
	}
	
	function get_modules_count(){
		return $this->module->count();
	}
	
	function get_branches_list(){
		$list	=	array();
		foreach($this->branch as $branch){
			array_push($list,array($branch->id,$branch->name));
		}
		return $list;
	}
	function get_branches_count(){
		return $this->branch->count();
	}
}