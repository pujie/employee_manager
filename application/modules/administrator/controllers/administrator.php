<?php
class Administrator extends CI_Controller{
var $data;
var $user;
	function __construct(){
		parent::__construct();
		$this->load->library('lib_table_manager');
		$this->load->library('menu');
		$this->load->library('lib_raw_menu');
		$this->load->library('simple_auth');
		$this->load->library('session');
		$this->load->model('general');
		$this->load->model('user_data');
		$this->data['css']=$this->general->css();
		$this->data['menu']=$this->general->create_menu();
		if($this->simple_auth->is_logged_in($this->session->userdata['id'])){
			$this->user	=	new User_data();
		}
	}
	function index(){
		$this->user->set_title('Administrator');
		$this->user->set_navigator(array(array(anchor('app_modules','Modules'),anchor('simple_auth_users/index','Users'),anchor('branches','Branches'))));

		$this->data['user']	=	$this->user;
		$this->load->view('index',$this->data);
	}
}