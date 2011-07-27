<?php
class Branches extends CI_Controller{
var $data = array();
var $pagination_attributes;

	function __construct(){
		parent::__construct();
		$this->load->model('branch');
		$this->load->model('simple_auth_user');
		$this->load->model('general');
		$this->load->model('user_data');
		$this->load->library('session');
		$this->load->library('pagination');
		$this->load->library('lib_table_manager');
		$this->load->library('menu');
		$this->load->helper('form');
		$this->load->helper('url');
		$this->data['css']		= $this->general->css();
		$this->data['menu']		= $this->general->create_menu();
	}
	function index(){
		$branches = new Branch;
		$branches->get();
		$list=array();
		foreach ($branches as $branch){
			array_push($list,array(
				$branch->id,
				$branch->name,
				anchor('branches/edit/' . $branch->id,'Edit'),
				anchor('branches/delete/' . $branch->id,'Delete'),
				anchor('branches/show_clients/' . $branch->id,'Clients')
				));
		}
		$this->data['list'] 	= 	$list;
		$this->data['title']	= 	'<h1>List of Branches</h1>';
		$this->data['links']	= 	$this->user_data->get_links($this->session->userdata('id'));
		$this->data['navigator']=	$this->navigator();
		$this->load->view('Branches/index',$this->data);
	}
	function add(){
		$this->load->view('branches/add');
	}
	function edit(){
		$branch_id = $this->uri->segment(3);
		$branches = new Branch;
		$branches->where('id',$branch_id)->get();
		$branches->simple_auth_user->get();
		$list = array();
		foreach($branches->simple_auth_user as $user){
			array_push($list,array($user->id,humanize($user->username),anchor('branches/edit_user','Edit User'),anchor('branches/delete_user','Delete User')));
		}
		$this->data['title']='<h1>Edit ' . humanize($branches->name) . ' Branch</h1>';
		$this->data['list'] = $list;
		$this->data['branch_id']=$branch_id;
		$navigator=array();
		array_push($navigator,array(anchor('branches/add_user/' . $branch_id,'Add User'),anchor('branches','Back to Branches')));
		$this->data['navigator']=$navigator;
		$this->load->view('branches/edit',$this->data);
	}
	function add_user(){
		$users = new Simple_auth_user;
		$users->get();
		$list = array();
		foreach($users as $user){
			array_push($list,array($user->id=>$user->username)) ;
		}
		$this->data['users']=$list;
		$this->data['branch_id']=$this->uri->segment(3);
		$this->data['title']='<h1>Add Branch\'s User</h1>';
		$this->load->view('branches/add_user',$this->data);
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
		$id=$this->uri->segment(3);
		$per_page=2;
		$page=$this->uri->segment(4);

		$this->pagination_attributes['base_url'] = base_url() . '/index.php/branches/show_clients/' . $id;
		$branches = new Branch;
		$branches->where('id',$id);
		$branches->get();
		
		if($page == null){
		$page=1;
		}
		$this->pagination_attributes['total_rows'] = $branches->client->count();
		$this->pagination_attributes['per_page'] = $per_page;
		
		$branches->client->get($per_page,$page);
		$this->pagination->initialize($this->pagination_attributes);

		$list=array();
		foreach($branches->client as $client){
		array_push($list,array($client->ID, $client->NAMA_PELANGGAN));
		}
		$this->data['list']=$list;
		$this->data['title']='<h1>' . $branches->name . '\'s Clients</h1>';
		$this->load->view('branches/show_clients',$this->data);
	}
	function  navigator(){
		$list=array();
		array_push($list,array(anchor('branches/add','Add Branch'),anchor('UserManager/logout','Logout')));
		return $list;
	}
}