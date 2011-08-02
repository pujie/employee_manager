<?php
class Branches extends CI_Controller{
var $user;
var $data = array();
var $pagination_attributes;

	function __construct(){
		parent::__construct();
		$this->load->model('branch');
		$this->load->model('general');
		$this->load->model('user_data');
		$this->load->library('pagination');
		$this->load->library('authentication');
		$this->load->library('lib_table_manager');
		$this->load->library('menu');
		$this->data['css']		= $this->general->css();
		$this->data['menu']		= $this->general->create_menu();
		$this->data['links']	= 	$this->user_data->get_links($this->session->userdata('id'));
		if($this->simple_auth->is_logged_in()){
			$this->user	=	new User_data;
		}
	}
	function index(){
		if($this->authentication->is_authenticated()){
			$branches = new Branch;
			$this->user->set_title('Branches');
			$this->user->set_pagetitle('Branches');
			$this->user->set_navigator(array(array(
				anchor('branches/add','Add Branches'),
				anchor('front_page/index','Logout'))));
			$this->data['user']		=	$this->user;
			$this->data['branches']	=	$branches;
			$this->load->view('Branches/index',$this->data);
		}
	}
	function add(){
		$this->user->set_navigator(array(array(
				anchor('branches/add','Add Branches'),
				anchor('front_page/index','Logout'))));
		$this->user->set_pagetitle('Add Branch');
		$this->user->set_title('Add Branch');
		$this->data['user']=$this->user;
		$this->load->view('branches/add',$this->data);
	}
	function edit(){
		if($this->authentication->is_authenticated()){
			$branch_id = $this->uri->segment(3);
			$branches = new Branch;
			$branches->where('id',$branch_id)->get();
			$branches->simple_auth_user->get();
			$this->data['title']='<h1>Edit ' . $branches->name . ' branch</h1>';
			$this->data['branch']=$branches;
			$this->user->set_title('Edit  ' . $branches->name . ' branch');
			$this->user->set_pagetitle('Edit  ' . $branches->name . ' branch');
			$this->user->set_navigator(array(array(
				anchor('branches','Back to Branches'),
				anchor('front_page/index','Logout'))));
			$this->data['user']=$this->user;
			$this->load->view('branches/edit',$this->data);
		}
	}
	function users(){
		if($this->authentication->is_authenticated()){
			$branch_id = $this->uri->segment(3);
			$branches = new Branch;
			$branches->where('id',$branch_id)->get();
			$this->data['branch_id']	=	$branch_id;
			$this->user->set_navigator(array(array(
				anchor('branches/add_user/' . $branch_id,'Add User'),
				anchor('branches','Back to Branches'),
				anchor('front_page/logout','Logout'))));
			$this->user->set_title('Branch Users');
			$this->user->set_pagetitle('Branch Users');
			$this->data['branch']	=	$branches;
			$this->data['user']		=	$this->user;
			
			$this->load->view('branches/users',$this->data);
		}
	}
	function add_user(){
		if($this->authentication->is_authenticated()){
			$users = new Simple_auth_user;
			$users->get();
			$list = array();
			foreach($users as $user){
				array_push($list,array($user->id=>$user->username)) ;
			}
			$this->data['users']=$list;
			$this->data['branch_id']=$this->uri->segment(3);
			$this->user->set_title('Add User');
			$this->user->set_pagetitle('Add User');
			$this->user->set_navigator(array(array(
				anchor('branches/users/' . $this->data['branch_id'],'User'),
				anchor('branches','Back to Branches'),
				anchor('front_page/logout','Logout'))));
			$this->data['user']=$this->user;
			$this->load->view('branches/add_user',$this->data);
		}
	}
	function add_user_handler(){
		$params = $this->input->post();
		$user = new Simple_auth_user;


		$user->where('id',$params['user_id']);
		$user->get();
		$branch = new Branch;
		$branch->where('id',$params['branch_id']);
		$branch->get();
		
		$branch->save($user);	
		redirect('branches/edit/' . $params['branch_id'],'refresh');
	}
	function show_clients(){
		if($this->authentication->is_authenticated()){
			$id=$this->uri->segment(3);
			$per_page	=	10;
			$page=$this->uri->segment(4);
			$branches = new Branch;
			$branches->where('id',$id);
			$branches->get();
			
			if($page == null){
				$page	=	0;
			}
			$branches->set_client_list($id);

			$this->data['branch_client']	=	$branches;

			$this->user->set_title(humanize($this->user->get_user()) . ' \'sClients');
			$this->user->set_pagetitle(humanize($this->user->get_user()) . ' \'s Clients');
			$this->user->set_navigator(array(array(
				anchor('branches/users/' . $id,'User'),
				anchor('branches','Back to Branches'),
				anchor('front_page/logout','Logout'))));
			$this->data['user']			=	$this->user;
			$this->load->view('branches/show_clients',$this->data);
		}
	}
}