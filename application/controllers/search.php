<?php
class Search extends CI_Controller{
	function __construct(){
		parent::__construct();
		$this->load->model('client');
	}
	function index(){
		$clients=new Client;
		$clients->ilike('name',$this->uri->segment(3));
		$clients->or_ilike('applicant',$this->uri->segment(3));
		$clients->or_ilike_related_service('name',$this->uri->segment(3));
		$clients->or_ilike_related_category('name',$this->uri->segment(3));
		$clients->or_ilike_related('sale/user','username',$this->uri->segment(3));
		$clients->get();
		foreach($clients as $client){
			echo $client->name . ', ' . $client->applicant  . ', ' . $client->service->name  . 
				', ' . $client->category->name .', ' . $client->sale->user->username. '<br>';
		}
	}
	function sales(){
		$client=new Client;
		$client->get();
		echo $client->name;
		echo $client->sales_id;
	}
}