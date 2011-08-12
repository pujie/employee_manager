<?php
class Categories extends CI_Controller{
	function __construct(){
		parent::__construct();
		$this->load->model('category');
	}
	function index(){
		$categories = new Category;
		$categories->get();
		$c=0;
		foreach($categories as $category){
			$list[$c] = array($category->kategori,anchor('categories/detail/' . $category->id,'Edit','class="table_button"'));
			$c++;
		}
		$data	=	array(
			'list'=>$list,
			'navigator'=>array(array(anchor('/','Home','class="button"'),anchor('categories/back_one_page','Back','class="button"'),anchor('front_page/logout','Logout','class="button"')))
			);
		$this->load->view('categories/index',$data);
	}
	function back_one_page(){
		echo '<script type="text/javascript">go.back(-1)</script>';
	}
	function detail(){
		$id = $this->uri->segment(3);
		$categories = new Category;
		$categories->where('id',$id);
		$categories->get();
		$categories->client->get()->order_by('name');
		echo $categories->kategori;
		$c = 0;
		foreach($categories->client->all as $client){
			$list[$c] = $client->name;
			$c++;
		}
		$this->lib_table_manager->create_table($list);
	}
}