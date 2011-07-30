<?php
class UserManager extends CI_Controller{
	var $data = array();
	function __construct(){
		parent::__construct();
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->model('general');
		$this->load->library('menu');
		$this->load->library('session');
		$this->load->library('simple_auth');
		if($this->simple_auth->is_logged_in()){
			$this->load->library('user_data');
			$session_id 				= 	$this->session->userdata('session_id');
			$ip_address 				= 	$this->session->userdata('ip_address');
			$user_agent 				= 	$this->session->userdata('user_agent');
			$user_data					= 	$this->session->userdata('user_data');
			$last_activity 				= 	$this->session->userdata('last_activity');
			$this->data['session_id']	=	$session_id;
			$this->data['ip_address']	=	$ip_address;
			$this->data['user_agent']	=	$user_agent;
			$this->data['last_activity']=	$last_activity;
			$this->data['user_data']	=	$user_data;
			$this->data['username']		=	$this->session->userdata('username');
			$this->data['email']		=	$this->session->userdata('email');
		}
	}
	function index(){
		if($this->simple_auth->is_logged_in()){
			$this->load->view('UserManager/login',$this->data);
		}
		else
		{
			$this->load->view('UserManager/not_loged_in');
		}
	}
	function create_user(){
		$this->data['title']='<h1>Create User</h1>';
		$this->load->view('UserManager/create_user',$this->data);
	}
	function create_user_handler(){
			$params = $this->input->post();
			$status = $this->simple_auth->create_user($params['username'],$params['userpassword'],$params['email']);
			echo $status;
	}
	function change_password(){
		if($this->simple_auth->is_logged_in()){
			$this->data['title'] 		= '<h1>Change Password</h1>';
			$this->data['login_status'] = 'You are logged in';
			$this->load->view('UserManager/change_password',$this->data);
		}else{
			echo 'You are not logged in yet';
		}
	}
	function change_password_handler(){
		if($this->input->post('new_password')==$this->input->post('confirm_password')){
			$this->simple_auth->change_password($this->input->post('new_password'));
			echo 'You have successfully change your password';
		}
		else{
			echo 'the new password you type are not same';
		}
	}
	function login(){
		$this->load->view('UserManager/login',$this->data);
	}
	function login_handler(){
		$this->data['logout_link']		=	anchor('UserManager/logout','Logout');
		$username=$this->input->post('name');
		$password=$this->input->post('password');
		if($this->simple_auth->log_in($username,$password)){
			$this->data['success']		=	TRUE;

			$this->load->view('UserManager/index',$this->data);
		}
		else
		{
			$this->data['success']		=	FALSE;
			echo 'You are not logged in yet';
		}
	}
	function logout(){
		$this->simple_auth->log_out('UserManager/index');
		echo 'Good bye';
	}
	function destroy_session(){
		$this->session->sess_destroy();
	}
}