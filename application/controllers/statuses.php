<?php
class Statuses extends CI_Controller{
	function __construct(){
		parent::__construct();
	}
	function index(){
		$statuses=new Status;
		$statuses->get();
		foreach($statuses as $status){
		echo $status->id . ', ' . $status->name . '<br>';
		}
	}
	function add(){
	echo form_open('statuses/add_handler');
	echo form_input('id','Id');
	echo form_input('name','Name');
	echo form_submit('save','Save');
	echo form_close();
	}
	function add_handler(){
		$param=$this->input->post();
		$status=new Status;
		$status->id=$param['id'];
		$status->name=$param['name'];
		$status->save();
		redirect('statuses');
	}
	function edit(){
		$status=new Status;
		$status->where('id',$this->uri->segment(3));
		$status->get();
		echo form_open('statuses/edit_handler');
		echo form_input('id',$status->id);
		echo form_input('name',$status->name);
		echo form_submit('save','Save');
		echo form_close();
	}
	function edit_handler(){
		$param=$this->input->post();
		$status=new Status;
		$status->where('id',$param[id]);
		$status->update('name',$param['name']);
		redirect('statuses','refresh');
	}
	function delete(){
		$this->load->view('statuses/delete');
	}
	function delete_handler(){
		$status=new Status;
		$status->where('id',$this->uri->segment(3));
		$status->get();
		$status->delete();
		redirect('statuses');
	}
}