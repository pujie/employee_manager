<?php
class Index extends CI_Controller{
var $user_data;
var $data;
	function __construct(){
		parent::__construct();
		$this->config->load('padi_config');
	}
	function index(){
		if($this->simple_auth->is_logged_in()){
			$user=new User;
			$this->user_data=new User_data;		
			$user->where('id',$this->session->userdata('id'));
			$user->get();
			$this->data['menu']	=	$this->general->create_menu();
			$this->data['title']	=	'<h1>Welcome to PadiNet ...' . humanize($this->session->userdata('username')) . '</h1>';
			$this->data['branch']	=	$user->branch->name;
			$this->data['modules']	=	$user->module->name;
			$links=$this->user_data->get_links();
			$navigator=array(
				anchor('/','Home','class="button"'),
				anchor('front_page/logout','Logout','class="button"'));
			$navigator=array_merge(array(anchor('/','Home','class="button"')),$links[0],array(anchor('front_page/logout','Logout','class="button"')));
			$this->user_data->set_navigator(array($navigator));
			$this->data['user_data']=$this->user_data;
			$this->load->view('index',$this->data);
		}
		else{
			redirect('front_page/login');
		}
	}
}
