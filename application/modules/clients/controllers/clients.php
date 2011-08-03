<?php
class Clients extends CI_Controller{
var $data;
var $authentication;
var $head;
var $body;
var $pagination_attributes;
	function __construct(){
		parent::__construct();
		$this->load->model('client');
		$this->load->model('general');
		$this->data['css']			=	$this->general->css();
		$this->load->library('lib_table');
		$this->data['head']			=	array('CLIENT CODE','CLIENT NAME','BRANCH','CATEGORY','SERVICE','EDIT');
		if($this->simple_auth->is_logged_in()){
			$this->load->model('user_data');
			$this->data['username'] = 	$this->session->userdata['username'];
			$this->data['userid'] 	= 	$this->session->userdata['id'];
			$this->authentication=new Authentication;
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
			if($this->uri->segment(4)<>null){
			$clients				=	$branch->client->like('NAMA_PELANGGAN',$this->uri->segment(4));
			$pagination_attribute['per_page']	=10;
			}
			else{
			$clients				= 	$branch->client->get();
			$clients->set_pagination_attributes(10,$clients->count(),base_url() . '/index.php/clients/list_clients/');
			$pagination_attribute	=	$clients->get_pagination_attributes();
			}
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
			$header=array('CLIENT CODE','CLIENT NAME','BRANCH','CATEGORY','SERVICE','EDIT');
			$body=array();
			foreach($clients as $client){
				array_push($body,array(
						$client->KODE_PELANGGAN,
						$client->NAMA_PELANGGAN, 
						$client->branch->name, 
						$client->category->KATEGORI, 
						$client->service->LAYANAN,
						anchor('clients/edit/' . $client->id,'Edit')
					)
				);
			}
			$this->data['head']=$header;
			$this->data['body']=$body;
			$this->head=$header;
			$this->body=$body;
			$this->pagination->initialize($pagination_attribute);
			$this->user_data->set_title('Clients');
			$this->user_data->set_navigator(array(array(anchor('clients/add','Add Client'),anchor('front_page/logout','Logout'))));
			$this->load->view('index',$this->data);
		}
	}
	
	function add(){
		if($this->authentication->is_authenticated()){
			$fields=$this->db->list_fields('clients');
			$this->data['fields']=$fields;
			$this->load->view('add',$this->data);
		}
	}
	function add_handler(){
		$client=new Client;
		$fields=$this->db->list_fields('clients');
		$params=$this->input->post();
		foreach($fields as $field){
			if ($field<>'id'){
			$client->$field=$params[$field];
			}
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
			redirect('clients/list_clients/find/' . $params['search']);
		}
		if($params['resetsubmit']){
			redirect('clients/list_clients');
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
	function get_excel(){
		$filename='clients.xls';
		$this->output->set_header('Content-type: application/ms-excel');
		$this->output->set_header('Content-Disposition: attachment; filename='.$filename);
		echo $this->lib_table->set_table('clients',$this->head,$this->body);
		// echo '<table><tr><td>satyu</td><td>duwya</td><td>tigya</td></tr></table>';
	}
}