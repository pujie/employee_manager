<?php
class Index extends CI_Controller{
var $data;
	function __construct(){
		parent::__construct();
		$this->load->library('simple_auth');
		$this->load->library('session');
		$this->load->library('menu');
		$this->load->model('general');
		$this->load->model('simple_auth_user');
		$this->config->load('padi_config');
	}
	function index(){
		if($this->simple_auth->is_logged_in()){
			$user=new Simple_auth_user;
			$user->where('id',$this->session->userdata('id'));
			$user->get();
			$this->data['menu']=$this->general->create_menu();
			$this->data['css']=$this->general->css();
			$this->data['title']='<h1>Welcome to PadiNet ...' . humanize($this->session->userdata('username')) . '</h1>';
			$this->data['branch']=$user->branch->name;
			$this->data['modules']=$user->module->name;
			$this->load->view('index',$this->data);
		}
		else{
			redirect('UserManager/login');
		}
	}
}