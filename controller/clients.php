<?php
class Clients extends CI_Controller{
	function __construct(){
		parent::__construct();
		$this->load->model('client');
		$this->load->library('lib_table_manager');
	}
	function index(){
		$clients=new Client;
		$clients->get();
		$c=0;
		foreach($clients as $client){
			$list[$c] = array($client->KODE_PELANGGAN,$client->NAMA_PELANGGAN, $client->NAMA_PEMOHON);
			$c++;
		}
		$this->lib_table_manager->create_table($list);
	}
	function category(){
		$clients = new Client;
		$clients->get();
		$clients->category->get();//->order_by('KATEGORI');
		foreach($clients->category as $categ){
			echo $categ->KATEGORI;
		}
	}
	function detail(){
		$id = $this->uri->segment(3);
		$clients = new Client;
		$clients->where('id',$id);
		$clients->get();
		$clients->category->get()->order_by('id');
		echo $clients->NAMA_PELANGGAN . ',' . $clients->category_id;
		echo $clients->category->KATEGORI;
	}
	function service(){
		$id = $this->uri->segment(3);
		$clients = new Client;
		$clients->where('id',$id);
		$clients->get();
		echo $clients->NAMA_PELANGGAN;
		$clients->service->get();
		echo $clients->service->LAYANAN;
	}

}