<?php
class Simple_auth_users extends CI_Controller{
var $user;
var $data = array();
var $current_url;
	function __construct(){
		parent::__construct();
		$this->load->helper('form');
		$this->load->library('lib_table_manager');
		$this->load->library('session');
		$this->load->library('simple_auth');
		$this->load->library('menu');
		$this->load->library('authentication');
		$this->load->model('simple_auth_user');
		$this->load->model('general');
		if($this->simple_auth->is_logged_in()){
			$this->load->model('user_data');
			$this->user=new User_data;
		}
	}
	function index(){
		if($this->authentication->is_authenticated()){
			$users = new Simple_auth_user;
			$heading = array('Id', 'Name','Email','Edit','Delete','Modules','Branches');
			$this->data['heading'] 	=	$heading;
			$this->data['title']	=	'<h1>User List</h1>';
			$this->current_url 		= 	$_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . '//' . $_SERVER['REQUEST_URI'];
			$this->data['users']	=	$users;
			$this->user->set_pagetitle('User List');
			$this->user->set_title('User List');
			$this->user->set_navigator(array(array(anchor('Simple_auth_users/add','Add User'),anchor('front_page/logout','Logout'))));
			$this->data['user']=	$this->user;
			$this->load->view('Simple_auth_users/index',$this->data);
		}
	}
	function add(){
		if($this->authentication->is_authenticated()){
			$this->data['title']='<h1>Add User</h1>';
			$this->load->view('simple_auth_users/add',$this->data);
		}
	}
	function add_handler(){
		if($this->authentication->is_authenticated()){
			$params = $this->input->post();
			$status = $this->simple_auth->create_user($params['username'],$params['userpassword'],$params['email']);
			redirect('simple_auth_users','refresh');
		}
	}
	function edit(){
		if($this->authentication->is_authenticated()){
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
	}
	function edit_handler(){
		if($this->authentication->is_authenticated()){
			$user = new Simple_auth_user;
			$id = $this->input->post('id');
			$username	= $this->input->post('username');
			$password	= $this->input->post('password');
			$email	= $this->input->post('email');
			$user->where('id',$id)->get();
			$user->where('id',$id)->update(array('username'=>$username,'password'=>$password,'email'=>$email));
			$this->simple_auth->change_password_user($password,$user->id,$user->salt);
		}
	}
	function show_modules(){
		if($this->authentication->is_authenticated()){
			$module_user = new Simple_auth_user;
			$id = $this->uri->segment(3);
			$module_user->where('id',$id);
			$module_user->get();
			$this->user->set_navigator(array(array(
				anchor('Simple_auth_users','Back to Users'),
				anchor('UserManager/logout','Logout'))));
			$this->user->set_title(humanize($module_user->username) . '\'s modules: ');
			$this->data['module_user']		=	$module_user;
			$this->data['user']				=	$this->user;
			$this->load->view('simple_auth_users/show_modules',$this->data);
		}
	}	
	function add_module(){
		if($this->authentication->is_authenticated()){
			$user=new Simple_auth_user;
			$user->where('id',$this->uri->segment(3));
			$user->get();
			$this->data['title']='<h1>Add ' . humanize($user->username) . '\'s Module</h1>';
			$this->data['user']=$user;
			$modules	= new Module;
			$modules->get();
			$this->data['modules']=$modules;
			$this->load->view('simple_auth_users/add_module',$this->data);
		}
	}
	function add_module_handler(){
		if($this->authentication->is_authenticated()){
			$params	=	$this->input->post();
			$user=new Simple_auth_user;
			$user->where('id',$params['id']);
			$user->get();
			foreach($params['modules'] as $module_id){
				$module=new Module;
				$module->where('id',$module_id);
				$module->get();
				$user->save($module);
			}
			redirect('simple_auth_users');
		}
	}
	function show_branches(){
		if($this->authentication->is_authenticated()){
			$id = $this->uri->segment(3);
			$branch_user = new Simple_auth_user;
			$branch_user->where('id',$id);
			$branch_user->get();
			$list=array();
			foreach($branch_user->branch as $branch){
				array_push($list,array($branch->id, $branch->name));
			}
			$this->user->set_pagetitle(humanize($branch_user->username) . '\'s Branch');
			$this->user->set_title(humanize($branch_user->username) . '\'s Branch');
		
			$this->user->set_navigator(array(array(
				anchor('Simple_auth_users','Back to Users'),
				anchor('UserManager/logout','Logout'))));
			$this->data['branch_user']	=	$branch_user;
			$this->data['user']			= 	$this->user;
			$this->load->view('simple_auth_users/branches',$this->data);
		}
	}
}