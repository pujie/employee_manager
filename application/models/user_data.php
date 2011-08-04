<?php
class User_data extends CI_Model{
var $obj;
var $current_user;
var $title;
var $page_title;
var $navigator;
	function __construct(){
		parent::__construct();
		$this->load->library('session');
		$this->obj	=	& get_instance();
		$this->current_user=new Simple_auth_user;
		$this->current_user->where('id',$this->obj->session->userdata['id']);
		$this->current_user->get();
	}
	function get_links(){
		$modules=array();
		$list_modules = array();
		foreach($this->current_user->module as $module){
			array_push($list_modules,anchor($module->url,$module->name,'class="button"'));
		}
		array_push($modules,$list_modules);
		return $modules;
	}
	function get_user(){
		return $this->current_user->username;
	}
	function set_navigator($navigator){
		$this->navigator=$navigator;
	}
	function get_navigator(){
		return $this->navigator;
	}
	function set_title($title){
		$this->title='<h1>' . $title . '</h1>';
	}
	function get_title(){
		 return $this->title;
	}
	function set_pagetitle($title){
		$this->page_title='<title>' . $title . '</title>';
	}
	function get_pagetitle(){
		 return $this->page_title;
	}

}