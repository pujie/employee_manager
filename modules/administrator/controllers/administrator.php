<?php
class Administrator extends CI_Controller{
var $data;
	function __construct(){
		parent::__construct();
		$this->load->library('lib_table_manager');
		$this->load->library('menu');
		$this->load->library('lib_raw_menu');
		$this->load->model('general');
		$this->load->model('user_data');
		$this->load->library('session');
		$this->data['css']=$this->general->css();
		$this->data['menu']=$this->general->create_menu();
	}
	function index(){
		$menu=array(array(anchor('app_modules','Modules'),anchor('simple_auth_users/index','Users'),anchor('branches','Branches')));
		$this->data['title']='<h1>Administrator</h1>';
		$this->data['sub_menu']=$menu;
		$this->data['navigator']=$this->user_data->get_links($this->session->userdata('id'));
		$this->load->view('index',$this->data);
	}
}