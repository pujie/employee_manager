<?php
class Clients extends CI_Controller{
var $data;
var $ordertype='desc';
var $authentication;
var $pagination_attributes;
	function __construct(){
		parent::__construct();
		$this->load->model('client');
		$this->load->model('branch');
		$this->load->model('category');
		$this->load->model('service');
		$this->load->model('contact');
		$this->load->library('OLERead');
		$this->config->load('padi_config');
		switch($this->uri->segment(2)){
			case 'index':
				$order_segment=$this->uri->segment(4);
				$page_segment='index';
				break;
			case 'cari':
				$order_segment=$this->uri->segment(5);
				$page_segment='cari/' . $this->uri->segment(3);
				break;
			default:
				$order_segment=$this->uri->segment(4);
				$page_segment='index';
							}
		switch ($order_segment){
			case 'asc':
				$order='desc';
				break;
			case 'desc':
				$order='asc';
				break;
			default:
				$order='desc';
		}
		$this->data['head']			=	array(
			anchor('clients/' . $page_segment . '/kode_pelanggan/' . $order,'KODE',array('class'=>'header')),
			anchor('clients/' . $page_segment . '/name/' . $order,'NAMA PELANGGAN',array('class'=>'header')),
			anchor('clients/' . $page_segment . '/branch_id/' . $order,'CABANG',array('class'=>'header')),
			anchor('clients/' . $page_segment . '/category_id/' . $order,'KATEGORI',array('class'=>'header')),
			anchor('clients/' . $page_segment . '/service_id/' . $order,'LAYANAN',array('class'=>'header')),
			anchor('clients/' . $page_segment . '/status_id/' . $order,'STATUS',array('class'=>'header')),
			anchor('clients/' . $page_segment . '/applicant/' . $order,'PEMOHON',array('class'=>'header')),
			anchor('clients/' . $page_segment . '/sale_id/' . $order,'SALES',array('class'=>'header')),
			anchor('clients/' . $page_segment . '/monthly_subscription_fee/' . $order,'HARGA LANGGANAN(Rp)',array('class'=>'header')),
			'ACTION');
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
	function name_order(){
		
	}
	function index(){
		if ($this->authentication->is_authenticated()){
			$user=new User;
			$user->where('id',$this->session->userdata['id']);
			$user->get();
			$branch=$user->branch->get_iterated();
			if($this->uri->segment(3)<>null){
				switch ($this->uri->segment(3)){
					case 'name_order':
						$clients				= 	$branch->client->get_iterated();
						echo 'name order';
						break;
					default:
						$clients=$branch->client;
						$pagination=array(
							'uri_segment'=>5,
							'total_rows'=>$clients->count(),
							'base_url'=>base_url() . 'index.php/clients/index/' . $this->uri->segment(3) . '/' . $this->uri->segment(4),
							'per_page'=>10);
						$page=$this->uri->segment(5);
						switch ($this->uri->segment(3)){
							case 'status_id':
								$clients->order_by_related('status','name',$this->uri->segment(4))->get(10,$page);
							case 'sale_id':
								$clients->order_by_related('sale/user','username',$this->uri->segment(4))->get(10,$page);
							case 'branch_id':
								$clients->order_by_related('branch','name',$this->uri->segment(4));
							case 'category_id':
								$clients->order_by_related('category','name',$this->uri->segment(4));
							case 'service_id':
								$clients->order_by_related('service','name',$this->uri->segment(4));
							default:
								$clients->order_by($this->uri->segment(3),$this->uri->segment(4))->get(10,$page);
						}
				}
			}else{
				redirect('clients/index/kode_pelanggan/asc/0');
			}
			if($this->uri->segment(3) == null){
				$page	=	0;
			}
				else
			{	
				$page	= $this->uri->segment(5);
			}
			$body=array();
			foreach($clients as $client){
				array_push($body,array(
						$client->kode_pelanggan,
						$client->name, 
						$client->branch->name, 
						$client->category->name, 
						$client->service->name,
						$client->status->name,
						$client->applicant,
						humanize($client->sale->user->username),
						number_format($client->monthly_subscription_fee,2,'.',','),
						anchor('clients/edit/index/' . '/' . $this->uri->segment(3) . '/' . $this->uri->segment(4) . '/' . $page . '/' . $client->id ,'Edit','class="table_button"')
					)
				);
			}
			$form_array	=	array(
				'row_count'=>$clients->count(),
				'body'=>$body,
				'current_url'=> current_url()
			);
			$this->pagination->initialize($pagination);
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
	function cari(){
		if ($this->authentication->is_authenticated()){
			$user=new User;
			$user->where('id',$this->session->userdata['id']);
			$user->get();
			$search_param=$this->uri->segment(3);
			

			$branch=$user->branch->get_iterated();
						$temp=$branch->client->like('name',$search_param)->
						or_ilike('applicant',$search_param)->
						or_ilike_related_service('name',$search_param)->
						or_ilike_related_category('name',$search_param)->
						or_ilike_related('sale/user','username',$search_param);
						$page_amount= $temp->get()->result_count();

						if($this->uri->segment(6)<>null){
							$page=$this->uri->segment(6);
						}
						else{
							$page=0;
						}
						
						switch ($this->uri->segment(4)){
							case 'status_id':
								$clients				=	$branch->client->like('name',$search_param)->
								or_ilike('applicant',$search_param)->
								or_ilike_related_service('name',$search_param)->
								or_ilike_related_category('name',$search_param)->
								or_ilike_related('sale/user','username',$search_param)->order_by_related('status','name',$this->uri->segment(5))->get(10,$page);
							case 'sale_id':
								$clients				=	$branch->client->like('name',$search_param)->
								or_ilike('applicant',$search_param)->
								or_ilike_related_service('name',$search_param)->
								or_ilike_related_category('name',$search_param)->
								or_ilike_related('sale/user','username',$search_param)->order_by_related('sale/user','username',$this->uri->segment(5))->get(10,$page);
							case 'branch_id':
								$clients				=	$branch->client->like('name',$search_param)->
								or_ilike('applicant',$search_param)->
								or_ilike_related_service('name',$search_param)->
								or_ilike_related_category('name',$search_param)->
								or_ilike_related('sale/user','username',$search_param)->order_by_related('branch','name',$this->uri->segment(5));
							case 'category_id':
								$clients				=	$branch->client->like('name',$search_param)->
								or_ilike('applicant',$search_param)->
								or_ilike_related_service('name',$search_param)->
								or_ilike_related_category('name',$search_param)->
								or_ilike_related('sale/user','username',$search_param)->order_by_related('category','name',$this->uri->segment(5));
							case 'service_id':
								$clients				=	$branch->client->like('name',$search_param)->
								or_ilike('applicant',$search_param)->
								or_ilike_related_service('name',$search_param)->
								or_ilike_related_category('name',$search_param)->
								or_ilike_related('sale/user','username',$search_param)->order_by_related('service','name',$this->uri->segment(5));
							default:
								$clients				=	$branch->client->like('name',$search_param)->
								or_ilike('applicant',$search_param)->
								or_ilike_related_service('name',$search_param)->
								or_ilike_related_category('name',$search_param)->
								or_ilike_related('sale/user','username',$search_param)->order_by($this->uri->segment(4),$this->uri->segment(5))->get(10,$page);
							}
			$body=array();
			foreach($clients as $client){
				array_push($body,array(
						$client->kode_pelanggan,
						$client->name, 
						$client->branch->name, 
						$client->category->name, 
						$client->service->name,
						$client->status->name,
						$client->applicant,
						humanize($client->sale->user->username),
						number_format($client->monthly_subscription_fee,2,'.',','),
						anchor('clients/edit/cari/' . $search_param . '/' . $this->uri->segment(4) . '/' . $this->uri->segment(5) . '/' . $page . '/' . $client->id ,'Edit','class="table_button"')
					)
				);
			}
			$pagination=array(
			'total_rows'=>$page_amount,
			'uri_segment'=>6,
			'base_url'=>base_url() . 'index.php/clients/cari/' . $search_param . '/' . $this->uri->segment(4) . '/' . $this->uri->segment(5) . '/',
			'per_page'=>10);

			$this->pagination->initialize($pagination);
			$data=array('body'=>$body,'head'=>$this->data['head'],'row_count'=>$page_amount);
			$this->load->view('index',$data);
		}
	}
	function find_handler(){
		$params=$this->input->post();
		if($params['submit']){
	//		redirect('clients/index/find/' . $params['search']);
			redirect('clients/cari/' . $params['search'] . '/kode_pelanggan/asc/0');
		}
		if($params['resetsubmit']){
			redirect('clients/index');
		}
	}
	
	
	function add(){
		if($this->authentication->is_authenticated()){
			$user_data=new User_data;
			$fields=$this->db->list_fields('clients');
			$this->data['fields']=$fields;
			$data=array(
				'fields'=>$fields,
				'user_data'=>$user_data, 
			'navigator'=>array(array(anchor('/','Home','class="button"'),anchor('clients','Back to Clients','class="button"'),anchor('front_page/logout','Logout','class="button"'))));
			$this->load->view('add',$data);
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
//	function edit_handler_(){
//		if($this->authentication->is_authenticated()){
//						echo 'log : ' . $this->session->userdata('id') . '<br>';
//			$client=new Client;
//			$params=$this->input->post();
//			$fields=$this->db->list_fields('clients');
//			foreach($fields as $field){
//				$client->$field=$params[$field];
//			}
//			$client->save();
//			$log=new Activity_log;
//			echo 'log : ' . $this->session->userdata('id') . '<br>';
//			$log->add_log('Modify client ' . $params['company'],$this->session->userdata('id'));
////			redirect($params['last_url']);
//		}
//	}
	
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
	function edit(){
		$categories=new Category;
		$categories->get();
		$data['categories']=$categories;
		$branches=new Branch;
		$branches->get();
		$data['branches']=$branches;
		$services=new Service();
		$services->get();
		$data['services']=$services;
		$this->load->model('sale');
		$sales=new Sale;
		$sales->get();
		$data['sales']=$sales;
		$business_fields=new Business_field();
		$business_fields->get();
		$data['business_fields']=$business_fields;
		$client=new Client;
		$client->where('id',$this->uri->segment(5));
		$client->get();
		$data['client']=$client;
		$this->load->view('edit',$data);
	}
	function edit_handler(){
		if($this->authentication->is_authenticated()){
			$client=new Client;
			$params=$this->input->post();
			$client->where('id',$params['id'])->update(array(
				'no_fb'=>$params['nofb'],
				'fb_date'=>$params['tglfb'],
				'activation_date'=>$params['tglaktivasi'],
				'subscription_period'=>$params['periodelangganan'],
				'sale_id'=>$params['accountmanager'],
				'name'=>$params['company'],
				'business_field_id'=>$params['business_fields'],
				'siup'=>$params['siupp'],
				'npwp'=>$params['npwp'],
				'address'=>$params['alamat'],
				'telp'=>$params['telepon'],
				'fax'=>$params['fax'],
				'applicant'=>$params['pemohonname'],
				'no_id'=>$params['ktppemohon'],
				'telp_hp'=>$params['telppemohon'],
				'hp'=>$params['hppemohon'],
				'hp2'=>$params['hp2pemohon'],
				'email'=>$params['emailpemohon'],
				
			));
			foreach($params as $key=>$value){
				echo $key . ' => ' . $value . '<br>';
			}
//			//administrasi
//			$client->contact->select('id')->get();
//			if($client->contact->count>0){
//			$client->contact->update_all('name',$params['administrasiname']);
//			}else{
//			$contact=new Contact();
//			$contact->name=$params['administrasiname'];
//			$contact->tipe='administrasi';
//			$contact->telp_hp=$params['telpadministrasi'];
//			$contact->hp=$params['hpadministrasi'];
//			$contact->hp2=$params['hp2administrasi'];
//			$contact->email=$params['emailadministrasi'];
//			$contact->client_id=$params['id'];
//			$contact->save();
//			$client->save($contact);
//			}
			$log=new Activity_log;
			echo 'log : ' . $this->session->userdata('id') . '<br>';
			$log->add_log('Modify client ' . $params['company'],$this->session->userdata('id'));
			
		}
	}
	function upload(){
		$this->load->view('upload_form');
	}
	function do_upload()
	{
		$config['upload_path'] = './uploads/';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size']	= '100';
		$config['max_width']  = '1024';
		$config['max_height']  = '768';
		$this->load->library('upload', $config);

		if ( ! $this->upload->do_upload())
		{
			$error = array('error' => $this->upload->display_errors());
			$this->load->view('upload_form', $error);
		}
		else
		{
			$data = array('upload_data' => $this->upload->data());
			$this->load->view('upload_success', $data);
		}
	}
	
	function reset_contact(){
		$contacts=new Contact();
		$contacts->get();
		$contacts->delete_all();
		$contacts=new Contact;
		$query="ALTER TABLE contacts AUTO_INCREMENT=0";
		$contacts->query($query);
	}
	function reset_client(){
		$clients=new Client;
		$clients->get();
		$clients->delete_all();
		$clients=new Client;
		$query="ALTER TABLE clients AUTO_INCREMENT=0";
		$clients->query($query);
	}
	function import_contact_administrasi(){
		$data = new Spreadsheet_Excel_Reader();
		$data->setOutputEncoding('CP1251');
		$data->read($this->config->item('master_client'));
		for ($x = 2; $x <= count($data->sheets[7]["cells"]); $x++) {
			$contact=new Contact();
			$contact->name=$data->sheets[7]["cells"][$x][1];
			$contact->telp_hp=$data->sheets[7]["cells"][$x][2];
			$contact->hp=$data->sheets[7]["cells"][$x][3];
			$contact->hp2=$data->sheets[7]["cells"][$x][4];
			$contact->email=$data->sheets[7]["cells"][$x][5];
			$contact->client_id=$data->sheets[7]["cells"][$x][7];
			$contact->tipe='administrasi';
			$contact->save();
		}
	}
	function import_contact_teknis(){
		$data = new Spreadsheet_Excel_Reader();
		$data->setOutputEncoding('CP1251');
		$data->read($this->config->item('master_client'));
		echo count($data->sheets[7]["cells"]);
		for($x=2;$x<=count($data->sheets[8]["cells"]);$x++){
			$contact=new Contact();
			$contact->name=$data->sheets[8]["cells"][$x][1];
			$contact->telp_hp=$data->sheets[8]["cells"][$x][2];
			$contact->hp=$data->sheets[8]["cells"][$x][3];
			$contact->hp2=$data->sheets[8]["cells"][$x][4];
			$contact->email=$data->sheets[8]["cells"][$x][5];
			$contact->client_id=$data->sheets[8]["cells"][$x][7];
			$contact->tipe='teknis';
			echo $data->sheets[8]["cells"][$x][1];
			echo $data->sheets[8]["cells"][$x][2];
			$contact->save();
		}
	}
	function import_contact_tagihan(){
		$data = new Spreadsheet_Excel_Reader();
		$data->setOutputEncoding('CP1251');
		$data->read($this->config->item('master_client'));
		
		for($x=2;$x<=count($data->sheets[9]["cells"]);$x++){
			$contact=new Contact();
			$contact->name=$data->sheets[9]["cells"][$x][1];
			$contact->telp_hp=$data->sheets[9]["cells"][$x][2];
			$contact->hp=$data->sheets[9]["cells"][$x][3];
			$contact->hp2=$data->sheets[9]["cells"][$x][4];
			$contact->email=$data->sheets[9]["cells"][$x][5];
			$contact->client_id=$data->sheets[9]["cells"][$x][7];
			$contact->tipe='penagihan';
			$contact->save();
		}
	}
	function import_contact_support(){
		$data = new Spreadsheet_Excel_Reader();
		$data->setOutputEncoding('CP1251');
		$data->read($this->config->item('master_client'));
		
		for($x=2;$x<=count($data->sheets[10]["cells"]);$x++){
			$contact=new Contact();
			$contact->name=$data->sheets[10]["cells"][$x][1];
			$contact->telp_hp=$data->sheets[10]["cells"][$x][2];
			$contact->hp=$data->sheets[10]["cells"][$x][3];
			$contact->hp2=$data->sheets[10]["cells"][$x][4];
			$contact->email=$data->sheets[10]["cells"][$x][5];
			$contact->client_id=$data->sheets[10]["cells"][$x][7];
			$contact->tipe='support';
			$contact->save();
		}
	}
	function import_client(){
		$data = new Spreadsheet_Excel_Reader();
		$data->setOutputEncoding('CP1251');
		$data->read($this->config->item('master_client'));
		$this->load->model('client');
		$this->load->model('contact');
		for ($x = 2; $x <= count($data->sheets[0]["cells"]); $x++) {
			$client=new Client;
			$client->kode_pelanggan	=	$data->sheets[0]["cells"][$x][2];
			$client->name			= 	$data->sheets[0]["cells"][$x][10];
			$client->branch_id		=	$data->sheets[0]["cells"][$x][3];
			$client->category_id	=	$data->sheets[0]["cells"][$x][5];
			$client->service_id		=	$data->sheets[0]["cells"][$x][7];
			$client->lainnya		=	$data->sheets[0]["cells"][$x][9];
			$client->siup			=	$data->sheets[0]["cells"][$x][13];
			$client->npwp			=	$data->sheets[0]["cells"][$x][14];
			$client->address		=	$data->sheets[0]["cells"][$x][15];
			$client->telp			=	$data->sheets[0]["cells"][$x][16];
			$client->fax			=	$data->sheets[0]["cells"][$x][17];
			$client->applicant		=	$data->sheets[0]["cells"][$x][18];
			$client->no_fb			=	$data->sheets[0]["cells"][$x][19];
			$client->fb_date		=	$data->sheets[0]["cells"][$x][20];
			$client->no_id			=	$data->sheets[0]["cells"][$x][21];
			$client->telp_hp		=	$data->sheets[0]["cells"][$x][22];
			$client->hp				=	$data->sheets[0]["cells"][$x][23];
			$client->hp2			=	$data->sheets[0]["cells"][$x][24];
			$client->email			=	$data->sheets[0]["cells"][$x][25];
			$client->setup_fee					=	$data->sheets[0]["cells"][$x][26];
			$client->monthly_subscription_fee	=	$data->sheets[0]["cells"][$x][27];
			$client->device_fee					=	$data->sheets[0]["cells"][$x][28];
			$client->other_fee					=	$data->sheets[0]["cells"][$x][29];
			$client->service_information		=	$data->sheets[0]["cells"][$x][30];
			$client->activation_date			=	$data->sheets[0]["cells"][$x][31];
			$client->subscription_period		=	$data->sheets[0]["cells"][$x][32];
			$client->special_request			=	$data->sheets[0]["cells"][$x][31];
			$client->sales_id					=	$data->sheets[0]["cells"][$x][34];
			$client->status_id					=	$data->sheets[0]["cells"][$x][36];
			$client->save();
		}
		redirect('clients');
	}
	function test(){
		$client=new Client;
		$client->where('id',1);
		$client->get();
		echo $client->status_id . '<br>';
		echo $client->status->name . '<br>';
		echo $client->name . '<br>';
	}
}
