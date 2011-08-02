<?php
class Clients extends CI_Controller{
var $data;
var $pagination_attributes;
	function __construct(){
		parent::__construct();
		$this->load->model('client');
		$this->load->library('lib_table_manager');
		$this->load->library('menu');
		$this->load->helper('url');
		$this->load->library('pagination');
		$this->load->library('authentication');
		$this->load->model('general');
		$this->data['css']			=	$this->general->css();
		if($this->simple_auth->is_logged_in()){
			$this->load->model('user_data');
			$this->data['username'] = 	$this->session->userdata['username'];
			$this->data['userid'] 	= 	$this->session->userdata['id'];
		}
		else{
			$this->data['username'] = 	'';
			$this->data['userid'] 	= 	'';
		}
		$this->pagination_attributes['base_url'] = base_url() . '/index.php/clients/list_clients/';
	}
	
	function index(){
		redirect('clients/list_clients');
	}
	function list_clients(){
		if($this->authentication->is_authenticated()){
			$user=new Simple_auth_user;
			$user->where('id',$this->session->userdata['id']);
			$user->get();
			$branch					= 	$user->branch->get();
			$clients				= 	$branch->client->get();
			$clients->set_pagination_attributes(10,$clients->count(),base_url() . '/index.php/clients/list_clients/');
			$pagination_attribute	=	$clients->get_pagination_attributes();
			$page					= 	0;
			$per_page				= 	$pagination_attribute['per_page'];
			if($this->uri->segment(3) == null){
				$page	= 0;
			}
				else
			{	
				$page	= $this->uri->segment(3);
			}
			$clients->get($per_page,$page);
			$list=array();
			$this->lib_table_manager->set_heading(array('CLIENT CODE','CLIENT NAME','BRANCH','CATEGORY','SERVICE','EDIT'));
			foreach($clients as $client){
				array_push($list,array(
						$client->KODE_PELANGGAN,
						$client->NAMA_PELANGGAN, 
						$client->branch->name, 
						$client->category->KATEGORI, 
						$client->service->LAYANAN,
						anchor('clients/edit/' . $client->id,'Edit')
					)
				);
			}
			$this->data['list']=$list;
			$this->pagination->initialize($pagination_attribute);
			$this->user_data->set_title('Clients');
			$this->user_data->set_navigator(array(array(anchor('clients/add','Add'),anchor('front_page/logout','Logout'))));
			$this->load->view('index',$this->data);
		}
	}
	function edit(){
		if($this->authentication->is_authenticated()){
			$id=$this->uri->segment(3);
			$client=new Client;
			$user=new User_data;
			$user->set_pagetitle('Edit Client');
			$user->set_title('Edit Client');
			$user->set_navigator(array(array(anchor('Client/list_clients','Back to Clients'),anchor('front_page/logout','Logout'))));
			$client->where('id',$id);
			$client->get();
			$this->data['client']=$client;
			$this->data['user']=$user;
			$this->load->view('edit',$this->data);
		}
	}
	function find_handler(){
		$params=$this->input->post();
		if($params['submit']){
			redirect('clients/find/' . $params['search']);
		}
		if($params['resetsubmit']){
			redirect('clients/list_clients');
		}
	}
	function find(){
		$clients=new Client;
		$param=$this->uri->segment(3);
		$clients->like('NAMA_PELANGGAN',$param);
		$clients->set_pagination_attributes(10,$clients->count(),base_url() . '/index.php/clients/find/' . $param);
		$pagination_attribute=$clients->get_pagination_attributes();
		$clients->like('NAMA_PELANGGAN',$param);

		$clients->get($pagination_attribute['per_page'],0);
		$this->populate($clients);
	}	
	
	function populate($clients){
		$list=array();
		$pagination_attribute['per_page']=10;
		$pagination_attribute['page_rows']=$clients->count();
		$pagination_attribute	=	$clients->get_pagination_attributes();
		$page					= 	0;
		$per_page				= 	$pagination_attribute['per_page'];
		if($this->uri->segment(3) == null){
			$page	= 0;
		}
			else
		{	
			$page	= $this->uri->segment(3);
		}
		foreach($clients as $client){
			array_push($list,array(
					$client->KODE_PELANGGAN,
					$client->NAMA_PELANGGAN, 
					$client->branch->name, 
					$client->category->KATEGORI, 
					$client->service->LAYANAN,
					anchor('clients/edit/' . $client->id,'Edit')
				)
			);
		}
		$this->data['list']=$list;
		$this->pagination->initialize($pagination_attribute);
		$this->user_data->set_title('Clients');
		$this->user_data->set_navigator(array(array(anchor('clients/add','Add'),anchor('front_page/logout','Logout'))));
		$this->load->view('index',$this->data);
	}
	function get_fields(){
		$fields=$this->db->list_fields('clients');
		$client=new Client;
		$client->where('id',1)->get();
		echo $client->NAMA_PELANGGAN;
		foreach($fields as $field){
			echo $client->$field . '<br>';
		}
	}
	function edit_handler(){
		if($this->authentication->is_authenticated()){
			$client=new Client;
			
			
			$params=$this->input->post();
			
			$fields=$this->db->list_fields('clients');
			foreach($fields as $field){
				$client->$field=$params[$field];
			}
			$client->save();
		}
	}
	function navigator(){
		$navigator=array();
		array_push($navigator,array(anchor('front_page/logout','Logout'),anchor('clients/add','Add')));
		return $navigator;
	}
}