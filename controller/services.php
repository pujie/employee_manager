<?php
class Services extends CI_Controller{
	function __construct(){
		parent::__construct();
		$this->load->model('service');
		$this->load->library('lib_table_manager');
		$this->load->helper('url');
	}
	function index(){
		$services = new Service;
		$services->get();
		$c=0;
		foreach($services as $service){
			$list[$c] = array($service->LAYANAN,anchor('services/detail/' . $service->id,'Edit'));
			$c++;
		}
		if(empty($list)){
			echo '<div>The list is empty</div>';
		}else{
			$this->lib_table_manager->create_table($list);
		}
	}
	function detail(){
		$id = $this->uri->segment(3);
		$services = new Service;
		$services->where('id',$id);
		$services->get();
		$services->client->get()->order_by('NAMA_PELANGGAN');
		echo $services->LAYANAN;
		$c = 0;
		foreach($services->client->all as $client){
			$list[$c] = $client->NAMA_PELANGGAN;
			$c++;
		}
		if(empty($list)){
			echo '<div>The list is empty</div>';
		}else{
			$this->lib_table_manager->create_table($list);
		}
	}
}