<?php
class Business_fields extends CI_Controller{
	function __construct(){
		parent::__construct();
		$this->load->model('business_field');
	}
	function index(){
		$business_fields	=	new Business_field();
		$business_fields->get();
		foreach($business_fields as $field){
		echo $field->name . '<br>';
		}
	}
	function show_dropdown(){
		$option=array();
		$business_fields	=	new Business_field;
		$business_fields->get();
		foreach($business_fields as $field){
		$option[$field->id]	=	$field->name;
		}
		echo form_dropdown('business',$option);
	}
}