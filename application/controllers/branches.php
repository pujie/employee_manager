<?php
class Branches extends CI_Controller{
var $user;
var $data = array();
var $pagination_attributes;
var $authentication;
	function __construct(){
		parent::__construct();
		$this->load->model('branch');
		$this->authentication=new Authentication;
		$this->data['css']		= $this->general->css();
		$this->data['menu']		= $this->general->create_menu();
		if($this->simple_auth->is_logged_in()){
			$this->load->model('user_data');
			$this->user	=	new User_data;
			$this->data['links']	= 	$this->user_data->get_links($this->session->userdata('id'));
		}
	}
	function index(){
		if($this->authentication->is_authenticated()){
			$branches = new Branch;
			$this->user->set_title('Branches');
			$this->user->set_pagetitle('Branches');
			$this->user->set_navigator(array(array(
				anchor('/','Home','class="button"'),
				anchor('branches/add','Add Branches','class="button"'),
				anchor('front_page/index','Logout','class="button"'))));
			$this->data['user']		=	$this->user;
			$this->data['branches']	=	$branches;
			$this->load->view('Branches/index',$this->data);
		}
	}
	function add(){
		$this->user->set_navigator(array(array(
				anchor('/','Home','class="button"'),
				anchor('branches','Back to Branches','class="button"'),
				anchor('front_page/index','Logout','class="button"'))));
		$this->user->set_pagetitle('Add Branch');
		$this->user->set_title('Add Branch');
		$this->data['user']=$this->user;
		$this->load->view('branches/add',$this->data);
	}
	function add_handler(){
		$parameter=$this->input->post();
		$branch=new Branch;
		$branch->name=$parameter['name'];
		$branch->save();
		redirect('branches');
	}
	function edit(){
		if($this->authentication->is_authenticated()){
			$branch_id = $this->uri->segment(3);
			$branches = new Branch;
			$branches->where('id',$branch_id)->get();
			$branches->user->get();
			$this->data['title']='<h1>Edit ' . $branches->name . ' branch</h1>';
			$this->data['branch']=$branches;
			$this->user->set_title('Edit  ' . $branches->name . ' branch');
			$this->user->set_pagetitle('Edit  ' . $branches->name . ' branch');
			$this->user->set_navigator(array(array(
				anchor('/','Home','class="button"'),
				anchor('branches','Back to Branches','class="button"'),
				anchor('front_page/index','Logout','class="button"'))));
			$this->data['user']=$this->user;
			$this->load->view('branches/edit',$this->data);
		}
	}
	function edit_handler(){
		$params	=	$this->input->post();
		$branch	=	new Branch;
		$branch->where('id',$params['id']);
		$branch->update('name',$params['nama']);
		redirect('branches');
	}
	function users(){
		if($this->authentication->is_authenticated()){
			$branch_id = $this->uri->segment(3);
			$branches = new Branch;
			$branches->where('id',$branch_id)->get();
			$this->user->set_navigator(array(array(
				anchor('/','Home','class="button"'),
				anchor('branches/add_user/' . $branch_id,'Add User','class="button"'),
				anchor('branches','Back to Branches','class="button"'),
				anchor('front_page/logout','Logout','class="button"'))));
			$this->user->set_title('Branch Users');
			$this->user->set_pagetitle('Branch Users');
			$form_array	=	array(
				'branch'	=>	$branches,
				'user'		=>	$this->user,
				'branch_id'	=>	$branch_id
			);
			$this->data	=	array_merge($form_array,$this->data);
			$this->load->view('branches/users',$this->data);
		}
	}
	function add_user(){
		if($this->authentication->is_authenticated()){
			$users = new user;
			$users->get();
			$list = array();
			foreach($users as $user){
				array_push($list,array($user->id=>$user->username)) ;
			}
			$this->data['user']=$this->user;
			$data	=	array(
				'users'		=>	$list,
				'branch_id'	=>	$this->uri->segment(3),
				'navigator'	=>	array(array(
					anchor('branches/users/' . $this->uri->segment(3),'User','class="button"'),
					anchor('branches','Back to Branches','class="button"'),
					anchor('front_page/logout','Logout','class="button"')				
				))
			);
			$this->load->view('branches/add_user',$data);
		}
	}
	function add_user_handler(){
		$params = $this->input->post();
		$user = new user;
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
			$id			=	$this->uri->segment(3);
			$page		=	$this->uri->segment(4);
			$branches 	= 	new Branch;
			$branches->where('id',$id);
			$branches->get();
			$clients	=	$branches->client->get(10,$page);
			$list		=	array();
			foreach($clients as $client){
				array_push($list,array($client->id,$client->name));
			}
			$data	=	array(
				'clients'	=>	$list,
				'navigator'	=>	array(array(anchor('/','Home','class="button"'),anchor('branches','Branches','class="button"'),anchor('front_page/logout','Logout','class="button"')))
			);
			$this->pagination->initialize(array(
				'base_url'	=>	base_url() . 'index.php/branches/show_clients/' . $id,
				'total_rows'=>	$clients->count(),
				'per_page'	=>	10
				));
			$this->load->view('branches/show_clients',$data);
		}
	}
	function delete(){
		$this->load->view('branches/delete');
	}
	function delete_handler(){
		$branch	=	new Branch;
		$branch->where('id',$this->uri->segment(3))->get();
		$branch->delete();
		redirect('branches');
	}
}