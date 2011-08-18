<?php
class Departments extends CI_Controller{
	function __construct(){
		parent::__construct();
		$this->load->model('department');
	}
	function index(){
		if($this->authentication->is_authenticated()){
			$departments=new Department;
			$departments->get();
			$list=array();
			foreach($departments as $department){
				array_push($list, array(
					$department->id,
					$department->name,
					$department->description,
					anchor('departments/edit','Edit','class="table_button"'),
					anchor('departments/delete','Delete','class="table_button"') ));
			}
			$user_data=new User_data;
			$data=array('list'=>$list,'user_data'=>$user_data);
			$this->load->view('departments/index',$data);
		}
	}
	function add(){
		if($this->authentication->is_authenticated()){
			$this->load->view('departments/add');
		}
	}
	function add_handler(){
		if($this->authentication->is_authenticated()){
			$param=$this->input->post();
			$department=new Department;
			$department->name=$param['name'];
			$department->description=$param['description'];
			$department->save();
			redirect('departments','refresh');
		}
	}
	function edit(){
		if($this->authentication->is_authenticated()){
			$department=new Department;
			$department->where('id',$this->uri->segment(3));
			$department->get();
			echo form_open('departments/edit_handler');
			echo form_hidden('id',$this->uri->segment(3));
			echo form_input('name',$department->name);
			echo form_input('description',$department->description);
			echo form_submit('save','Save');
			echo form_close();
		}
	}
	function edit_handler(){
		if($this->authentication->is_authenticated()){
			$param=$this->input->post();
			$department=new Department;
			$content=array('name'=>$param['name'],'description'=>$param['description']);
			$department->where('id',$param['id']);
			$department->update($content);
			redirect('departments','refresh');
		}
	}
}