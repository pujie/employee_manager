<?php
class Data_table extends CI_Controller{
	function __construct(){
		parent::__construct();
		$this->load->library('lib_table');
	}
	function index(){
		$this->load->view('data_table');
	}
}