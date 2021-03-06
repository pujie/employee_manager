<?php
class Front_page extends CI_Controller{
	var $user_data;
	var $data = array();
	function __construct(){
		parent::__construct();

		if($this->simple_auth->is_logged_in()){
			$this->load->model('user_data');
			$this->data['session_id']	=	$this->session->userdata('session_id');
			$this->data['ip_address']	=	$this->session->userdata('ip_address');
			$this->data['user_agent']	=	$this->session->userdata('user_agent');
			$this->data['user_data']	=	$this->session->userdata('user_data');
			$this->data['last_activity']=	$this->session->userdata('last_activity');
			$this->data['menu'] 		= 	$this->general->create_menu();
			$this->data['userid']		=	$this->session->userdata('id');
			$this->data['username']		=	$this->session->userdata('username');
			$this->data['email']		=	$this->session->userdata('email');
			$this->data['links']		=	$this->user_data->get_links($this->session->userdata('id'));
		}
		}
	function index(){
		if($this->authentication->is_authenticated()){
			$this->load->view('front_page/login');
		}
	}
	function create_user(){
		if($this->authentication->is_authenticated()){
			$this->data['title']='<h1>Create User</h1>';
			$this->load->view('front_page/create_user',$this->data);
		}
	}
	function create_user_handler(){
		if($this->authentication->is_authenticated()){
			$params = $this->input->post();
			$status = $this->simple_auth->create_user($params['username'],$params['userpassword'],$params['email']);
			echo $status;
		}
	}
	function change_password(){
		if($this->authentication->is_authenticated()){
			$this->data['title'] 		= '<h1>Change Password</h1>';
			$this->data['login_status'] = 'You are logged in';
			$this->load->view('front_page/change_password',$this->data);
		}
	}
	function change_password_handler(){
		if($this->authentication->is_authenticated()){
			if($this->input->post('new_password')==$this->input->post('confirm_password')){
				$this->simple_auth->change_password($this->input->post('new_password'));
				echo 'You have successfully change your password';
			}
			else{
				echo 'the new password you type are not same';
			}
		}
	}
	function login(){
		$this->data['title']='<h1>Login </h1>';
		$this->load->view('front_page/login',$this->data);
	}
	function login_handler(){
		$this->data['logout_link']		=	anchor('front_page/logout','Logout');
		$username						=	$this->input->post('name');
		$password						=	$this->input->post('password');
		if($this->simple_auth->log_in($username,$password)){
			redirect('/');
		}
		else{
			$this->data['success']		=	FALSE;
			$this->load->view('front_page/not_loged_in');
		}
	}
	function logout(){
		$this->simple_auth->log_out('front_page/index');
		echo 'Good bye';
	}
	function destroy_session(){
		$this->session->sess_destroy();
	}
	function list_modules(){
		if($this->authentication->is_authenticated()){
			$user = new Simple_auth_user;
			$user->where('id',$this->data['userid']);
			$user->get();
			$list=array();
			$modules=array();
			foreach($user->module as $module){
				array_push ($modules,anchor($module->url,$module->name));
			}
			array_push($list,$modules);
			return $list;
		}
	}
	function navigator(){
		$list=array();
		array_push($list,array(anchor('front_page/logout','Logout')));
		return $list;
	}
}
