<?php
class Jquery extends CI_Controller{
	function __construct(){
		parent::__construct();
		$this->load->library('javascript');
		$this->config->load('javascript');

	}
	function index(){
		$data['library_src']=$this->jquery->script();
		$data['script_head']=$this->jquery->_compile();
		$this->load->view('jquery',$data);
	}
}