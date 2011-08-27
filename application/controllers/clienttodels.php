<?php
class Clienttodels extends CI_Controller{
	function __construct(){
		parent::__construct();
		$this->load->model('clienttodel');
	}
	function index(){
		$clients=new Client;
		$clients->get();
		echo $clients->name;
	}
}