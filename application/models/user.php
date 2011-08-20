<?php
class User extends DataMapper{
var $navigator;
	var $has_many = array('module','branch','activity_log');
	var $has_one=array('department','sales');
	function __construct(){
		parent::__construct();
	}

	function get_user_list(){
		$list=array();
		$this->get();
		foreach($this as $user){
			array_push($list,array($user->id,
				$user->username,$user->email,
				anchor('users/show_modules/' . $user->id,'Modules','class="table_button"'),
				anchor('users/show_branches/' . $user->id,'Branches','class="table_button"'),
				anchor('users/edit/' . $user->id,'Edit','class="table_button"'),
				anchor('users/delete/' . $user->id,'Delete','class="table_button"'),
				)
			);
		}
		return $list;
	}
	
	function get_user_count(){
		return $this->count();
	}
	
	function get_modules_list(){
		$list	=	array();
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