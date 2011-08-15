<?php
class users extends CI_Controller{
var $user;
var $data = array();
var $current_url;
	function __construct(){
		parent::__construct();
		$this->load->model('branch');
		$this->current_url 		= 	$_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . '//' . $_SERVER['REQUEST_URI'];
		if($this->simple_auth->is_logged_in()){
			$this->load->model('user');
			$this->load->model('user_data');
			$this->user=new User_data;
		}
	}
	function index(){
		if($this->authentication->is_authenticated()){
			$users = new User;
			$form_array=array(
				'heading' 	=> array('Id', 'Name','Email','Edit','Delete','Modules','Branches'),
				'title'		=>	'<h1>User List</h1>',
				'users'		=>	$users,
				'user'		=>	$this->user
			);
			$users->get(10,$this->uri->segment(3));
			$pagination=array('base_url'=>base_url() . 'index.php/users/index','per_page'=>'10','total_rows'=>$users->count());
			$this->data['pagination']=$pagination;
			$navigator=array(
				anchor('/','Home','class="button"'),
				anchor('users/add','Add User','class="button"'),
				anchor('front_page/logout','Logout','class="button"')
			);

		$list=array();
		$users->get(10,$this->uri->segment(3));
		foreach($users as $user){
			array_push($list,array($user->id,
				$user->username,$user->email,
				anchor('users/edit/' . $user->id,'Edit','class="table_button"'),
				anchor('users/delete/' . $user->id,'Delete','class="table_button"'),
				anchor('users/show_modules/' . $user->id,'Modules','class="table_button"'),
				anchor('users/show_branches/' . $user->id,'Branches','class="table_button"')));
		}
			$this->user->set_pagetitle('User List');
			$this->user->set_title('User List');
			$this->user->set_navigator(array($navigator));
			$data=array('list'=>$list,'pagination'=>$pagination,'user'=>$this->user,'users'=>$users);
			$this->data=array_merge($form_array,$this->data);
			$this->load->view('users/index',$data);
		}
	}
	function add(){
		if($this->authentication->is_authenticated()){
			$form_array=array(
				'name_label'	=>	array('class'=>'tableless_login_label','name'=>'namelabel'),
				'name'			=>	array('class'=>'tableless_login_input','name'=>'username'),
				'email_label'	=>	array('class'=>'tableless_login_label','name'=>'passlabel'),
				'email'			=>	array('class'=>'tableless_login_input','name'=>'email'),
				'pass_label'	=>	array('class'=>'tableless_login_label','name'=>'passlabel'),
				'password'		=>	array('class'=>'tableless_login_input','name'=>'userpassword'),
				'title'			=>	'<h1>Add New User</h1>'
			);
			$this->data		=	array_merge($form_array,$this->data);
			$this->load->view('users/add',$this->data);
		}
	}
	function add_handler(){
		if($this->authentication->is_authenticated()){
			date_default_timezone_set('Asia/Jakarta');
			$params = $this->input->post();
			$status = $this->simple_auth->create_user($params['username'],$params['userpassword'],$params['email']);
			$log=new Activity_log;
			$log->add_log('Add ' . $params['username'],$this->session->userdata('id'));
			redirect('users','refresh');
		}
	}
	function edit(){
		if($this->authentication->is_authenticated()){
			$id = $this->uri->segment(3);
			$user = new user;
			$user->where('id',$id);
			$user->get();
			$this->user->set_navigator(array(array(
				anchor('/','Home','class="button"'),
				anchor('users','Back to Users','class="button"'),
				anchor('front_page/logout','Logout','class="button"'))));
			$form_array=array(
				'userbefore' => array(
						  'name'        => 'username',
						  'id'          => 'username',
						  'value'       => $user->username,
						  'maxlength'   => '100',
						  'size'        => '50',
						  'style'       => 'width:150',
						),
				'passwordbefore' => array(
						  'name'        => 'password',
						  'id'          => 'password',
						  'value'       => $user->password,
						  'maxlength'   => '100',
						  'size'        => '50',
						  'style'       => 'width:200',
						),
				'emailbefore' => array(
						  'name'        => 'email',
						  'id'          => 'email',
						  'value'       => $user->email,
						  'maxlength'   => '100',
						  'size'        => '50',
						  'style'       => 'width:250',
						),
				'id'		=> $id,
				'title' 	=> '<h1>Edit User</h1>'
			);
			$this->data	=	array_merge($form_array,$this->data);
			$this->load->view('users/edit',$this->data);
		}
	}
	function edit_handler(){
		if($this->authentication->is_authenticated()){
			$user = new user;
			$id = $this->input->post('id');
			$username	= $this->input->post('username');
			$password	= $this->input->post('password');
			$email	= $this->input->post('email');
			$user->where('id',$id)->get();
			$user->where('id',$id)->update(array('username'=>$username,'password'=>$password,'email'=>$email));
			$log=new Activity_log;
			$log->add_log('Edit ' . $username,$this->session->userdata('id'));
			$this->simple_auth->change_password_user($password,$user->id,$user->salt);
		}
	}
	function show_modules(){
		if($this->authentication->is_authenticated()){
			$module_user = new User;
			$id = $this->uri->segment(3);
			$module_user->where('id',$id);
			$module_user->get();
			$modules=$module_user->module->get();			
			$this->user->set_navigator(array(array(
				anchor('/','Home','class="button"'),
				anchor('users','Back to Users','class="button"'),
				anchor('users/add_module/' . $id,'Add Modules','class="button"'),
				anchor('UserManager/logout','Logout','class="button"'))));
			$this->user->set_title(humanize($module_user->username) . '\'s modules: ');
			$form_array	=	array(
				'module_user'		=>	$module_user,
				'user'				=>	$this->user
			);
			$this->data	=	array_merge($form_array,$this->data);
			$this->load->view('users/show_modules',$this->data);
		}
	}	
	function add_module(){
		if($this->authentication->is_authenticated()){
			$user=new user;
			$user->where('id',$this->uri->segment(3));
			$user->get();
			$form_array	=	array(
				'title'		=>	'<h1>Add ' . humanize($user->username) . '\'s Module</h1>',
				'user'		=>	$user,
				'user'		=>	$user,
				'user_data'	=>	$this->user,
				'modules'	=>	$module_available
			);
			$this->user->set_navigator(array(array(
				anchor('/','Home','class="button"'),
				anchor('users','Back to Users','class="button"'),
				anchor('users/add_module','Add Modules','class="button"'),
				anchor('front_page/logout','Logout','class="button"'))));
			$modules			=	new Module;
			$modules->get();		
			$user_module 		=	$user->module;
			$module_available	=	new Module;
			$module_available->where_not_in('name',$user_module->name);
			$module_available->get();
			$this->data			=	array_merge($form_array,$this->data);
			$this->load->view('users/add_module',$this->data);
		}
	}
	function add_module_handler(){
		if($this->authentication->is_authenticated()){
			$params		=	$this->input->post();
			$user=new user;
			$user->where('id',$params['id']);
			$user->get();
			foreach($params['modules'] as $module_id){
				$module	=	new Module;
				$module->where('id',$module_id);
				$module->get();
				$user->save($module);
			}
			redirect('users');
		}
	}
	function show_branches(){
		if($this->authentication->is_authenticated()){
			$id = $this->uri->segment(3);
			$branch_user = new user;
			$branch_user->where('id',$id);
			$branch_user->get();
			$this->user->set_pagetitle(humanize($branch_user->username) . '\'s Branch');
			$this->user->set_title(humanize($branch_user->username) . '\'s Branch');
			$this->user->set_navigator(array(array(
				anchor('/','Home','class="button"'),
				anchor('users','Back to Users','class="button"'),
				anchor('users/add_branch/' . $id,'Add ' . humanize($branch_user->username) . '\'s Branch','class="button"'),
				anchor('front_page/logout','Logout','class="button"'))));
			$form_array	=	array(
				'branch_user'	=>	$branch_user,
				'user'			=> 	$this->user
			);
			$this->data	=	array_merge($form_array,$this->data);
			$this->load->view('users/branches',$this->data);
		}
	}
	function add_branch(){
		if($this->authentication->is_authenticated()){
		$user=new user;
		$id=$this->uri->segment(3);
		$user->where('id',$this->uri->segment(3))->get();
			$this->user->set_navigator(array(array(
				anchor('/','Home','class="button"'),
				anchor('users','Back to Users','class="button"'),
				anchor('front_page/logout','Logout','class="button"'))));
			$this->data['user_data']			= 	$this->user;
		$this->data['user']=$user;
		$this->load->view('users/add_branch',$this->data);
		}
	}
	function delete(){
		$data	=	array(
			'id'	=>	$this->uri->segment(3)
		);
		$this->load->view('users/delete',$data);
	}
	function delete_handler(){
		echo 'delete user ' . $this->uri->segment(3);
		$user	=	new User;
		$user->where('id',$this->uri->segment(3))->get();
			$log=new Activity_log;
			$log->add_log('Delete ' . $user->username,$this->session->userdata('id'));
		$user->delete();
		redirect('Users');
	}
	function stick(){
		$this->load->view('users/stick');
		
	}
}