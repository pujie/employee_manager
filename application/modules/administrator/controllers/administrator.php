<?php
class Administrator extends CI_Controller{
var $data;
var $user;
	function __construct(){
		parent::__construct();
		$this->load->library('lib_raw_menu');
		$this->data['css']=$this->general->css();
		$this->data['menu']=$this->general->create_menu();
		if($this->simple_auth->is_logged_in($this->session->userdata['id'])){
			$this->user	=	new User_data();
		}
	}
	function index(){
		$this->user->set_title('Administrator');
		$this->user->set_navigator(array(array(
			anchor('/','Home','class="button"'),
			anchor('app_modules','Modules','class="button"'),
			anchor('users/index','Users','class="button"'),
			anchor('branches','Branches','class="button"'),
			anchor('front_page/logout','Logout','class="button"'))));

		$this->data['user']	=	$this->user;
		$this->load->view('index',$this->data);
	}
}