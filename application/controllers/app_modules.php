<?php
class App_modules extends CI_Controller{
var $user;
var $data;
	function __construct(){
		parent::__construct();
		$this->load->model('module');
		$this->load->model('general');
		$this->load->model('user_data');
		$this->load->library('lib_table');
		$this->load->library('lib_table_manager');
		$this->load->library('menu');
		$this->config->load('padi_config');
		$this->data['menu']=$this->general->create_menu();
		if($this->simple_auth->is_logged_in($this->session->userdata['id'])){
			$this->user	=	new User_data;
		}
		}
	function index(){
		if($this->authentication->is_authenticated()){
			$modules = new Module;
			$modules->get();
			$list=array();
			foreach($modules as $module){
				array_push($list,array( 
					$module->id,$module->name,
					anchor('app_modules/edit/' . $module->id,'Edit','class="table_button"'),
					anchor('app_modules/uninstall','Uninstall','class="table_button"') ));
			}
			$this->data['list']=$list;
			$this->user->set_navigator(array(array(
				anchor('/','Home','class="button"'),
				anchor('app_modules/add','Add Modules','class="button"'),
				anchor('front_page/logout','Logout','class="button"'))));
			$this->user->set_title('Modules');
			$this->data['user']=$this->user;
			$this->load->view('app_modules/index',$this->data);
		}
	}
	function edit(){
		if($this->authentication->is_authenticated()){
			$this->user->set_title('Edit Modules');
			$id 		= $this->uri->segment(3);
			$module 	= new Module;
			$module->where('id',$id);
			$this->data['module'] = $module->get();
			$this->user->set_navigator(array(array(
				anchor('/','Home','class="button"'),
				anchor('app_modules','Back to Modules','class="button"'),
				anchor('UserManager/logout','Logout','class="button"'))));
			$this->data['user']=$this->user;
			$this->load->view('app_modules/edit',$this->data);
		}
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
		if($this->authentication->is_authenticated()){
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
}