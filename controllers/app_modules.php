<?php
class App_modules extends CI_Controller{
var $data;
	function __construct(){
		parent::__construct();
		$this->load->model('module');
		$this->load->model('general');
		$this->load->model('user_data');
		$this->load->library('session');
		$this->load->library('lib_table_manager');
		$this->load->library('menu');
		$this->load->helper('form');
		$this->config->load('padi_config');

		$this->data['menu']=$this->general->create_menu();
		}
	function index(){
		$modules = new Module;
		$modules->get();
		$list=array();
		foreach($modules as $module){
			array_push($list,array( $module->id,$module->name,anchor('app_modules/edit/' . $module->id,'Edit'),anchor('app_modules/uninstall','Uninstall') ));
		}
		$this->data['list']=$list;
		$this->data['navigator']=$this->user_data->get_links($this->session->userdata('id'));
		$this->data['title']='<h1>Modules</h1>';
		$this->load->view('app_modules/index',$this->data);
	}
	function edit(){
		$this->data['title']='<h1>Edit Modules</h1>';
		$id = $this->uri->segment(3);
		$module = new Module;
		$module->where('id',$id);
		$this->data['module'] = $module->get();
		$this->load->view('app_modules/edit',$this->data);
	}
	function edit_handler(){
		$params = $this->input->post();
		$module=new Module;
		$module->id=$params['id'];
		$module->name=$params['name'];
		$module->url=$params['url'];
		$module->save();
	}
	function users(){
		$modules = new Module;
		$modules->get();
		$modules->simple_auth_user->get();
		$list = array();
		foreach($modules as $module){
			foreach($module->simple_auth_user as $user){
				array_push($list,array($module->name,$user->id , $user->username));
			}
		}
		$this->lib_table_manager->set_heading(array('Module','User Id','User Name'));
		$this->lib_table_manager->create_table($list);
	}
}