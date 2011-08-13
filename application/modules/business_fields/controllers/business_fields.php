<?php
class Business_fields extends CI_Controller{
	function __construct(){
		parent::__construct();
		$this->load->model('business_field');
		$this->load->library('pagination');
	}
	function index(){
		$my_session	=	array(
			'current_url'	=>	current_url()
		);
		$this->session->set_userdata($my_session);
		$business_fields	=	new Business_field();
		$business_fields->get(10,$this->uri->segment(3));
		$list	=	array();
		foreach($business_fields as $field){
		array_push($list,array(
			$field->name,
			anchor('business_fields/edit/' . $field->id,'Edit','class="button"'),
			anchor('business_fields/delete/' . $this->uri->segment(3) . '/' . $field->id,'Delete','class="button"')));
		}
		$pagination	=	array(
			'per_page'	=>	10,
			'total_rows'=>	100,
			'base_url'	=>	base_url() . 'index.php/business_fields/index'
		);
		$this->pagination->initialize($pagination);
		$data	=	array(
			'fields'		=>	$list,
			'navigator'		=>	array(array(
				anchor('/','Home','class="button"'),
				anchor('business_fields/add/' . $this->uri->segment(3),'Add','class="button"'),
				anchor('front_page/logout','Logout','class="button"'))),
		);
		$this->load->view('index',$data);
	}
	function edit(){
		$last_url	= $this->session->userdata('current_url');
		$my_session	=	array(
			'current_url'	=>	current_url()
		);
		$this->session->set_userdata($my_session);
		$fields=new Business_field;
		$fields->where('id',$this->uri->segment(3));
		$fields->get();
		$data	=	array(
			'navigator'	=>	array(array(
				anchor('/','Home','class="button"'),
				anchor($last_url,'Fields','class="button"'),
				anchor('front_page/logout','Logout','class="button"'))),
			'fields'	=>	$fields,
			'id'		=>	$this->uri->segment(3)
		);
		$this->load->view('business_fields/edit',$data);
	}
	function edit_handler(){
		$last_url	= $this->session->userdata('current_url');
		$my_session	=	array(
			'current_url'	=>	current_url()
		);
		$this->session->set_userdata($my_session);
		$param	=	$this->input->post();
		$fields	=	new business_field;
		$fields->where('id',$param['id'])->update('name',	$param['name']);
		redirect('business_fields/index/' . $this->uri->segment(3));
	}
	function add(){
		$data	=	array(
			'navigator'	=>	array(array(
				anchor('/','Home','class="button"'),
				anchor('business_fields/index/' . $this->uri->segment(3),'Fields','class="button"'),
				anchor('front_page/logout','Logout','class="button"'))),
			'id'		=>	$this->uri->segment(3),
		);
		$this->load->view('business_fields/add',$data);
	}
	function add_handler(){
		$params	=	$this->input->post();
		$field	=	new Business_field;
		$field->name	=	$params['field'];
		$field->save();
		redirect('business_fields/index/' . $this->uri->segment(3));
	}
	function delete(){
		$field	=	new Business_field;
		$field->where('id',$this->uri->segment(4));
		$field->get();
		if($field->client->count>0){
			echo 'Cannot delete non empty business field';
		}
		else{
			$field->delete();
			redirect('business_fields/index/' . $this->uri->segment(3));
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