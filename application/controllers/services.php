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
			$list[$c] = array($service->layanan,anchor('services/detail/' . $service->id,'Edit','class="table_button"'));
			$c++;
		}
		$data	=	array(
			'list'=>$list,
			'navigator'=>array(array(anchor('/','Home','class="button"'),anchor('/','Back','class="button"'),anchor('front_page/logout','Logout','class="button"')))
			);
		$this->load->view('services/index',$data);
	}
	function detail(){
		$id = $this->uri->segment(3);
		$services = new Service;
		$services->where('id',$id);
		$services->get();
		$services->client->get()->order_by('name');
		echo $services->layanan;
		$c = 0;
		$list = array();
		foreach($services->client->all as $client){
			$list[$c] = array($client->name);
			$c++;
		}
		$data	=	array(
			'list'=>$list,
			'navigator'=>array(array(anchor('/','Home','class="button"'),anchor('front_page/logout','Logout','class="button"')))
		);
		$this->load->view('services/detail',$data);
	}
}