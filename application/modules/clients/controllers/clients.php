<?php
class Clients extends CI_Controller{
var $data;
var $authentication;
var $head=array('CLIENT CODE','CLIENT NAME','BRANCH','CATEGORY','SERVICE','EDIT');
var $pagination_attributes;
	function __construct(){
		parent::__construct();
		$this->load->model('client');
		$this->load->model('branch');
		$this->load->model('category');
		$this->load->model('service');
		$this->load->library('OLERead');
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
			$user=new User;
			$user->where('id',$this->session->userdata['id']);
			$user->get();
			$branch					= 	$user->branch->get_iterated();
			if($this->uri->segment(4)<>null){
				$clients				=	$branch->client->like('name',$this->uri->segment(4));
				$pagination_attribute['per_page']	=	10;
			}
			else{
				$clients				= 	$branch->client->get_iterated();
				$clients->set_pagination_attributes(10,$clients->count(),base_url() . '/index.php/clients/list_clients/');
				$pagination_attribute	=	$clients->get_pagination_attributes();
			}
			$page					= 	0;
			$per_page				= 	$pagination_attribute['per_page'];
			if($this->uri->segment(3) == null){
				$page	=	0;
			}
				else
			{	
				$page	= $this->uri->segment(3);
			}
			$clients->get($per_page,$page);
			$body=array();
			foreach($clients as $client){
				array_push($body,array(
						$client->kode_pelanggan,
						$client->name, 
						$client->branch->name, 
						$client->category->kategori, 
						$client->service->LAYANAN,
						anchor('clients/edit/' . $client->id . '?last_url=' . current_url(),'Edit','class="table_button"')
					)
				);
			}
			$form_array	=	array(
				'head'=>$this->head,
				'body'=>$body,
				'current_url'=> current_url()
			);
			$this->pagination->initialize($pagination_attribute);
			$this->user_data->set_title('Clients');
			$this->user_data->set_navigator(array(array(
				anchor('/','Home','class="button"'),
				anchor('clients/add','Add Client','class="button"'),
				anchor('categories','Categories','class="button"'),
				anchor('services','Services','class="button"'),
				anchor('clients/get_excel','Export to Excel','class="button"'),
				anchor('clients/import','Import from Excel','class="button"'),
				anchor('front_page/logout','Logout','class="button"'))));
				$this->data	=	array_merge($form_array,$this->data);
			$this->load->view('index',$this->data);
		}
	}
	
	function add(){
		if($this->authentication->is_authenticated()){
			$fields=$this->db->list_fields('clients');
			$this->data['fields']=$fields;
			$this->user_data->set_navigator(array(array(anchor('/','Home','class="button"'),anchor('clients','Back to Clients','class="button"'),anchor('front_page/logout','Logout','class="button"'))));
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
			$params=$this->input->get();
			$client=new Client;
			$user=new User_data;
			$user->set_pagetitle('Edit Client');
			$user->set_title('Edit Client');
			$user->set_navigator(array(array(
				anchor('/','Home','class="button"'),
				anchor($params['last_url'],'Back to Clients','class="button"'),
				anchor('front_page/logout','Logout','class="button"'))));
			$client->where('id',$id);
			$client->get();
			$form_data	=	array(
				'client'=>$client,
				'user'=>$user,
				'last_url'=>$params['last_url']
			);
			$this->data	=	array_merge($form_data,$this->data);
			$this->load->view('edit',$this->data);
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
			redirect($params['last_url']);
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
	
	function get_excel(){	
		$clients=new Client;
		$clients->get();
		$client_list=array();
		foreach($clients as $client){
			array_push($client_list,array($client->kode_pelanggan,$client->name,$client->branch->name,$client->category->name,$client->service));
		}
		$form_array	=	array(
		'head'			=>	array('CLIENT CODE','CLIENT NAME','BRANCH','CATEGORY','SERVICE'),
		'client_list'	=>	$client_list
		);
		$this->data	=	array_merge($form_array,$this->data);
		$this->load->view('get_excel',$this->data);
	}
	function import(){
		$this->user_data->set_navigator(array(
				anchor('clients/verify_import','IMPORT','class="button"'),
				array(anchor('/','Home','class="button"'),anchor('clients','Back to Clients','class="button"'),anchor('front_page','Logout','class="button"'))
			));
			$this->load->view('import');
	}
	function verify_import(){		
		error_reporting(E_ALL ^ E_NOTICE);
		$excel = new Spreadsheet_Excel_Reader("C:\\Users\Baltix\httpd\htdocs\store\internal2\excel\clients.xls");
		$excel->setOutputEncoding('CP1251');
		$head=array();
			foreach($this->db->list_fields('clients') as $key=>$value){
				array_push($head,$value);
			}
		$body=array();
		for ($x = 2; $x <= count($excel->sheets[0]["cells"]); $x++) {
			$body_item=array();
			foreach($this->db->list_fields('clients') as $key=>$value){
				$name = $excel->sheets[0]["cells"][$x][$key+1];
				array_push($body_item,$name);
			}
			array_push($body,$body_item);
		}
		$this->user_data->set_navigator(array(
				anchor('clients/execute_import','Execute','class="button"'),
				array(anchor('/','Home','class="button"'),anchor('clients','Back to Clients','class="button"'),anchor('front_page','Logout','class="button"'))
			));
		$data['head']=$head;
		$data['body']=$body;
		$this->load->view('verify_import',$data);
	}
	function execute_import(){
		error_reporting(E_ALL ^ E_NOTICE);
		$excel = new Spreadsheet_Excel_Reader("C:\\Users\Baltix\httpd\htdocs\store\internal2\excel\clients.xls");
		$excel->setOutputEncoding('CP1251');
		$head=array();
			foreach($this->db->list_fields('clients') as $key=>$value){
				array_push($head,$value);
			}
		$body=array();
		for ($x = 2; $x <= count($excel->sheets[0]["cells"]); $x++) {
			$client=new Client();
			foreach($this->db->list_fields('clients') as $key=>$value){
				if($key>0){
				$name = $excel->sheets[0]["cells"][$x][$key+1];
				//this is not good
				if($this->is_excel_date($name)){
					$name=$this->make_php_date($name);
				}
				$client->$value=$name;
				// echo $client->get_sql() . ' ' . $value . ' <br>';
				}
			}
			$client->save();
		}
		redirect('clients');
	}
	function is_excel_date($maybe_date){
		return preg_match( '`^\d{1,2}/\d{1,2}/\d{4}$`', $maybe_date ) ;
	}
	function make_php_date($excel_date){
		$tmp=explode('/',$excel_date);
		$result=$tmp[2] . '-' . $tmp[0] . '-' . $tmp[1];
		return $result;
	}
}