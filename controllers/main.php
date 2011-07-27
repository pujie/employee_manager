<?php
class Main extends CI_Controller{
	function __construct(){
		parent::__construct();
		$this->load->library('menu');
		$this->load->model('general');
	}
	function index(){
		$data['menu'] = $this->general->create_menu();
		$data['css'] = $this->general->css();
		$this->load->view('index',$data);
	}
}