<?php
class Simple_auth_users extends CI_Controller{
var $data = array();
var $current_url;
	function __construct(){
		parent::__construct();
		$this->load->helper('form');
		$this->load->library('lib_table_manager');
		$this->load->library('session');
		$this->load->library('simple_auth');
		$this->load->library('menu');
		$this->load->model('simple_auth_user');
		$this->load->model('general');
		$this->load->model('user_data');
		$this->data['username']		=	$this->session->userdata('username');
		$this->data['password']		=	$this->session->userdata('password');
		$this->data['email']		=	$this->session->userdata('email');
		$this->data['menu']			=	$this->general->create_menu();
		$this->data['css']			=	$this->general->css();
	}
	function index(){
		if($this->simple_auth->is_logged_in()){
			$users = new Simple_auth_user;
			$users->get();
			$heading = array('Name','Email','Edit','Delete','Modules','Branches');
			$this->data['heading'] = $heading;
			$list = array();
			foreach($users as $user){
				array_push($list,array(
					$user->username,
					$user->email,
					anchor('simple_auth_users/edit/' . $user->id,'Edit'),
					anchor('simple_auth_users/delete/' . $user->id,'Delete'),
					anchor('simple_auth_users/show_modules/' . $user->id,'Modules'),
					anchor('simple_auth_users/show_branches/' . $user->id,'Branches')));
			}
			$this->data['list'] 	= $list;
			$this->data['title']	= '<h1>User List</h1>';
			$this->current_url =  $_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . '//' . $_SERVER['REQUEST_URI'];
			$this->data['navigator']=$this->navigator();
			$this->data['links']=$this->user_data->get_links($this->session->userdata('id'));
			$this->load->view('Simple_auth_users/index',$this->data);
		}
		else{
			echo 'You are not logged in yet';
		}
	}
	function add(){
		$this->data['title']='<h1>Add User</h1>';
		$this->load->view('simple_auth_users/add',$this->data);
	}
	function add_handler(){
			$params = $this->input->post();
			$status = $this->simple_auth->create_user($params['username'],$params['userpassword'],$params['email']);
			redirect('simple_auth_users','refresh');
	}
	function edit(){
		$id = $this->uri->segment(3);
		$user = new Simple_auth_user;
		$user->where('id',$id);
		$user->get();
		$userbefore = array(
				  'name'        => 'username',
				  'id'          => 'username',
				  'value'       => $user->username,
				  'maxlength'   => '100',
				  'size'        => '50',
				  'style'       => 'width:150',
				);
		$passwordbefore = array(
				  'name'        => 'password',
				  'id'          => 'password',
				  'value'       => $user->password,
				  'maxlength'   => '100',
				  'size'        => '50',
				  'style'       => 'width:200',
				);
		$emailbefore = array(
				  'name'        => 'email',
				  'id'          => 'email',
				  'value'       => $user->email,
				  'maxlength'   => '100',
				  'size'        => '50',
				  'style'       => 'width:250',
				);
		$this->data['userbefore'] 		= $userbefore;
		$this->data['passwordbefore'] 	= $passwordbefore;
		$this->data['emailbefore'] 		= $emailbefore;
		$this->data['id']			= $id;
		$this->data['title'] = '<h1>Edit User</h1>';
		$this->load->view('simple_auth_users/edit',$this->data);
	}
	function edit_handler(){
		$user = new Simple_auth_user;
		$id = $this->input->post('id');
		$username	= $this->input->post('username');
		$password	= $this->input->post('password');
		$email	= $this->input->post('email');
		$user->where('id',$id)->get();
		$user->where('id',$id)->update(array('username'=>$username,'password'=>$password,'email'=>$email));
		$this->simple_auth->change_password_user($password,$user->id,$user->salt);
	}
	function show_modules(){
		$user = new Simple_auth_user;
		$id = $this->uri->segment(3);
		$user->where('id',$id);
		$user->get();
		$this->data['user'] = $user->username;
		$list = array();
		foreach($user->module as $module){
			array_push($list,array($module->id,$module->name));
		}
		$this->data['last_url'] = 'simple_auth_users';
		$this->data['list'] = $list;
		$this->data['title'] = '<h1>' . humanize($user->username) . '\'s modules: </h1>';
		$this->load->view('simple_auth_users/show_modules',$this->data);
	}	
	function show_branches(){
		$id = $this->uri->segment(3);
		$user = new Simple_auth_user;
		$user->where('id',$id);
		$user->get();
		$list=array();
		foreach($user->branch as $branch){
		array_push($list,array($branch->id, $branch->name));
		}
		$this->data['title']='<h1>'  . humanize($user->username) . '\'s Branch</h1>';
		$this->data['list']	= $list;
		$this->data['links']	= $this->user_data->get_links($this->session->userdata('id'));
		$this->load->view('simple_auth_users/branches',$this->data);
	}
	function navigator(){
		$list=array();
		// $navigator=array(anchor('Simple_auth_users/add','Add User'));
		array_push($list,array(anchor('Simple_auth_users/add','Add User'),anchor('UserManager/logour','Logout')));
		return $list;
	}
}