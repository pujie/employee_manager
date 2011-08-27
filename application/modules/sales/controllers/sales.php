<?php
class Sales extends CI_Controller{
	function __construct(){
		parent::__construct();
		$this->load->model('sale');
	}
	function index(){
		$sales=new Sale;
		$sales->get();
		$list=array();
		foreach($sales as $sale){
			array_push($list,array($sale->id,$sale->user->username,anchor('sales/delete/' . $sale->id,'Delete','class=table_button')));
		}
		$data=array('list'=>$list,
			'navigator'=>array(array(
				anchor('/','Home','class="button"'),
				anchor('sales/add','Add Sales','class="button"'),
				anchor('front_page/logout','Logout','class="button"'))));
		$this->load->view('index',$data);
	}
	function test(){
		$this->load->model('user');
		$users=new User;
		$users->get();
		$data['users']=$users;
		$this->load->view('common/header');
		$this->load->view('add',$data);
		$this->load->view('common/footer');
	}
	function add(){
		$this->load->model('user');
		$users=new User;
		$users->get();
		$data['users']=$users;
		$this->load->view('common/header');
		$this->load->view('add',$data);
		$this->load->view('common/footer');
		}
	function add_handler(){
		$param=$this->input->post();
		$sales=new Sale();
		$sales->user_id=$param['user'];
		$sales->save();
		redirect('sales');
	}
	function delete(){
		$sale=new Sale;
		$sale->where('id',$this->uri->segment(3))->get();
		$sale->delete();
		redirect('sales');
	}
}
