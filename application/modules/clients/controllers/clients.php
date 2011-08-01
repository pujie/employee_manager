<?php
class Clients extends CI_Controller{
var $data;
var $pagination_attributes;
	function __construct(){
		parent::__construct();
		$this->load->model('client');
		$this->load->model('Simple_auth_user');
		$this->load->library('lib_table_manager');
		$this->load->library('session');
		$this->load->library('menu');
		$this->load->library('simple_auth');
		$this->load->library('pagination');
		$this->load->library('authentication');
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->model('general');
		$this->load->model('user_data');
		$this->data['css']			=	$this->general->css();
		$this->data['menu']			=	$this->general->create_menu();	
		if($this->simple_auth->is_logged_in()){
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
			$branch		= $user->branch->get();
			$clients	= $branch->client->get();
			$page		= 0;
			$per_page	= 10;
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
			$this->pagination_attributes['total_rows'] = $clients->count();
			$this->pagination_attributes['per_page'] = $per_page;

			$this->pagination->initialize($this->pagination_attributes);
			$this->data['navigator']=$this->navigator();
			$this->data['links']=$this->user_data->get_links($this->data['userid']);;
			$this->data['title']='<h1>Clients</h1>';
			$this->load->view('index',$this->data);
		}
	}
	function edit(){
		if($this->authentication->is_authenticated()){
			$id=$this->uri->segment(3);
			$client=new Client;
			$client->where('id',$id);
			$client->get();
			$this->data['client']=$client;
			$this->data['list']=$this->edit_form($client);
			$this->load->view('edit',$this->data);
		}
	}
	function edit_handler(){
		if($this->authentication->is_authenticated()){
			$client=new Client;
			$params=$this->input->post();
			$client->KODE_PELANGGAN=$params['kode_pelanggan'];
			$client->NAMA_PELANGGAN=$params['nama_pelanggan'];
			$client->NAMA_PEMOHON=$params['nama_pemohon'];
			$client->LAINNYA=$params['lainnya'];
			$client->JENIS_USAHA=$params['jenis_usaha'];
			$client->NPWP=$params['npwp'];
			$client->SIUPP=$params['siupp'];
			$client->ALAMAT=$params['alamat'];
			$client->TELP=$params['telp'];
			$client->FAX=$params['fax'];
			$client->NO_FB=$params['no_fb'];
			$client->TGL_FB=$params['tgl_fb'];
			$client->NO_ID=$params['no_id'];
			$client->TELP_HP=$params['telp_hp'];
			$client->HP=$params['hp'];
			$client->HP2=$params['hp2'];
			$client->EMAIL=$params['email'];
			$client->BIAYA_SETUP=$params['biaya_setup'];
			$client->BIAYA_BERLANGGANAN_BULANAN=$params['biaya_berlangganan_bulanan'];
			$client->BIAYA_PERANGKAT=$params['biaya_perangkat'];
			$client->BIAYA_LAINNYA=$params['biaya_lainnya'];
			$client->KETERANGAN_LAYANAN=$params['keterangan_layanan'];
			$client->TGL_AKTIVASI=$params['tgl_aktivasi'];
			$client->PERIODE_LANGGANAN=$params['periode_langganan'];
			$client->REQUEST_KHUSUS=$params['request_khusus'];
			$client->ACCOUNT_MANAGER=$params['account_manager'];
			$client->STATUS=$params['status'];
			$client->TANGGAL=$params['tanggal'];
			$client->save();
		}
	}
	function edit_form($client){
		$list=array();
		array_push($list,array('<div id=contact>'));
		array_push($list,array('Code', form_input('kode_pelanggan',$client->KODE_PELANGGAN)));
		array_push($list,array('Client Name', form_input('nama_pelanggan',$client->NAMA_PELANGGAN)));
		array_push($list,array('Pemohon', form_input('nama_pemohon',$client->NAMA_PEMOHON)));

		array_push($list,array('Other', form_input('lainnya',$client->LAINNYA)));
		array_push($list,array('Jenis Usaha', form_input('jenis_usaha',$client->JENIS_USAHA)));

		array_push($list,array('NPWP', form_input('npwp',$client->NPWP)));
		array_push($list,array('SIUPP', form_input('siupp',$client->SIUPP)));
		array_push($list,array('Address', form_input('alamat',$client->ALAMAT)));
		array_push($list,array('Telp', form_input('telp',$client->TELP)));
		array_push($list,array('Fax', form_input('fax',$client->FAX)));

		array_push($list,array('No FB', form_input('no_fb',$client->NO_FB)));
		array_push($list,array('Tgl FB', form_input('tgl_fb',$client->TGL_FB)));
		array_push($list,array('ID', form_input('no_id',$client->NO_ID)));
		array_push($list,array('HP', form_input('telp_hp',$client->TELP_HP)));
		array_push($list,array('HP', form_input('hp',$client->HP)));
		array_push($list,array('HP', form_input('hp2',$client->HP2)));
		array_push($list,array('Email', form_input('email',$client->EMAIL)));
		array_push($list,array('<div>'));
		
		
		
		array_push($list,array('<div id=service>'));
		array_push($list,array('Setup Fee', form_input('biaya_setup',$client->BIAYA_SETUP)));

		array_push($list,array('Monthly Fee', form_input('biaya_berlangganan_bulanan',$client->BIAYA_BERLANGGANAN_BULANAN)));
		array_push($list,array('Device Fee', form_input('biaya_perangkat',$client->BIAYA_PERANGKAT)));
		array_push($list,array('Other Fee', form_input('biaya_lainnya',$client->BIAYA_LAINNYA)));
		array_push($list,array('Service Description', form_input('keterangan_layanan',$client->KETERANGAN_LAYANAN)));
		array_push($list,array('Activation Date', form_input('tgl_aktivasi',$client->TGL_AKTIVASI)));
		array_push($list,array('Periode Date', form_input('periode_langganan',$client->PERIODE_LANGGANAN)));
		array_push($list,array('Special Request', form_input('request_khusus',$client->REQUEST_KHUSUS)));
		array_push($list,array('Account Manger', form_input('account_manager',$client->ACCOUNT_MANAGER)));

		array_push($list,array('Status', form_input('status',$client->STATUS)));
		array_push($list,array('Date', form_input('tanggal',$client->TANGGAL)));
		array_push($list,array('Category ID', form_input('category_id',$client->CATEGORY_ID)));
		array_push($list,array('Branch ID', form_input('branch_id',$client->BRANCH_ID)));
		array_push($list,array('Service ID', form_input('service_id',$client->SERVICE_ID)));
		array_push($list,array('<div>'));
		return $list;
	}
	function navigator(){
		$navigator=array();
		array_push($navigator,array(anchor('UserManager/logout','Logout'),anchor('clients/add','Add')));
		return $navigator;
	}
}