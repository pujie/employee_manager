<?php
class Client extends DataMapper{
var $pagination_attribute;
		var $has_one = array(
		'category','service','branch','business_field','status'
	);
	function __construct(){
		parent::__construct();
	}
	function get_clients(){
		$list=array();
		foreach($clients as $client){
			array_push($list,array(
					$client->kode_pelanggan,
					$client->name, 
					$client->branch->name, 
					$client->category->kategori, 
					$client->service->LAYANAN,
					anchor('clients/edit/' . $client->id,'Edit')
				)
			);
		}
		return $list;
	}
	function get_count(){
		return $this->count();
	}
	function get_pagination_attributes(){
		return $this->pagination_attribute;
	}
	function set_pagination_attributes($per_page,$total_rows,$base_url){
		$this->pagination_attribute['per_page']	=	$per_page;//10;
		$this->pagination_attribute['total_rows']	=	$total_rows;//$this->get_count();
		// $this->pagination_attribute['base_url']	=	base_url() . '/index.php/clients/list_clients/';
		$this->pagination_attribute['base_url']	=	$base_url;
	}
}