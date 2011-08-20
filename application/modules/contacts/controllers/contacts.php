<?php
class Contacts extends CI_Controller{
	function __construct(){
		parent::__construct();
		$this->load->model('contact');
	}
	function index(){
		$contacts=new Contact();
		$contacts->get();
		$user_data=new User_data();
		$pagination=array('total_rows'=>$contacts->count(),'per_page'=>10,'base_url'=>base_url() . 'index.php/contacts/index');
		if($this->uri->segment(3)<>null){
			$page=$this->uri->segment(3);
		}else {
			$page=1;
		}
		$contacts->get(10,$page);
		$list=array();
		foreach ($contacts as $contact){
			array_push($list, array(
				$contact->name,
				$contact->client->name,
				$contact->telp_hp,
				$contact->hp,
				$contact->hp2,
				$contact->address,
				$contact->email,
				$contact->tipe,));
		}
		$this->pagination->initialize($pagination);
		$data=array('list'=>$list,'user_data'=>$user_data);
		$this->load->view('index',$data);
	}
}