<?php
class User_data extends CI_Model{
	function __construct(){
		parent::__construct();
		$this->load->model('simple_auth_user');
	}
	function get_links($id){
		$user=new Simple_auth_user;
		$user->where('id',$id);
		$user->get();
		$modules=array();
		$list_modules = array();
		foreach($user->module as $module){
		array_push($list_modules,anchor($module->url,$module->name));
		}
		array_push($modules,$list_modules);
		return $modules;
	}
}