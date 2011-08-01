<?php
class Categories extends CI_Controller{
	function __construct(){
		parent::__construct();
		$this->load->model('category');
		$this->load->library('lib_table_manager');
		$this->load->helper('url');
	}
	function index(){
		$categories = new Category;
		$categories->get();
		$c=0;
		foreach($categories as $category){
			$list[$c] = array($category->KATEGORI,anchor('categories/detail/' . $category->id,'Edit'));
			$c++;
		}
		$this->lib_table_manager->create_table($list);
	}
	function detail(){
		$id = $this->uri->segment(3);
		$categories = new Category;
		$categories->where('id',$id);
		$categories->get();
		$categories->client->get()->order_by('NAMA_PELANGGAN');
		echo $categories->KATEGORI;
		$c = 0;
		foreach($categories->client->all as $client){
			$list[$c] = $client->NAMA_PELANGGAN;
			$c++;
		}
		$this->lib_table_manager->create_table($list);
	}
}