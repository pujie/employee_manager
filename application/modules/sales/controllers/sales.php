<?php
class Sales extends CI_Controller{
	function __construct(){
		parent::__construct();
		$this->load->model('sale');
	}
	function index(){
		
	}
	function add(){
		$this->load->model('user');
		$users=new User;
		$users->get();
		foreach($users as $user){
			echo $user->username;
		}
	}
}
