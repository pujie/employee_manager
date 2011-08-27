<?php
class Reader extends CI_Controller{
	function __construct(){
		parent::__construct();
		$this->load->library('OLERead');
		error_reporting(E_ALL ^ E_NOTICE);
		$this->load->model('contact');
		$this->load->model('client');
		$this->config->load('padi_config');
	}
	function index(){
		error_reporting(E_ALL ^ E_NOTICE);
		$excel = new Spreadsheet_Excel_Reader($this->config->item('master_client'));
		$data['excel']=$excel;
		$this->load->view('excelreader/index',$data);
	}
	function phpinfo(){
		phpinfo();
	}
	function reset_data(){
		$this->reset_contact();
		$this->reset_client();
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
			echo $data->sheets[0]["cells"][$x][36] . '<br>';
			$client->save();
		}
//		redirect('clients');
	}
	function delete_all(){
		$clients=new Client;
		$clients->get();
		$clients->delete_all();
		redirect('clients');
	}
}