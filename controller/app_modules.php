<?php
class App_modules extends CI_Controller{
	function __construct(){
		parent::__construct();
		$this->load->model('module');
		$this->load->library('lib_table_manager');
		$this->load->model('general');
	}
	function index(){
		$modules = new Module;
		$modules->get();
		foreach($modules as $module){
		echo $module->name . ',';
		}
	}
	function users(){
		$modules = new Module;
		$modules->get();
		$modules->simple_auth_user->get();
		$list = array();
		foreach($modules as $module){
			foreach($module->simple_auth_user as $user){
				array_push($list,array($module->name,$user->id , $user->username));
			}
		}
		$this->lib_table_manager->set_heading(array('Module','User Id','User Name'));
		$this->lib_table_manager->create_table($list);
	}
}