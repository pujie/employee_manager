<?php
class Branch extends DataMapper{
var $obj;
var $has_many = array('user','client');
var $pagination_attributes;
	function __construct(){
		parent::__construct();
		$this->obj = & get_instance();
	}
	function get_branch_count(){
		return $this->count();
	}
	function get_branch_list(){
		$list=array();
		$this->get();
		foreach($this as $branch){
			array_push($list,array($branch->id,$branch->name,					
				anchor('branches/edit/' . $branch->id,'Edit','class="table_button"'),
				anchor('branches/delete/' . $branch->id,'Delete','class="table_button"'),
				anchor('branches/users/' . $branch->id,'Users','class="table_button"'),
				anchor('branches/show_clients/' . $branch->id,'Clients','class="table_button"')
			));
		}
		return $list;
	}
	function get_user_count(){
		return $this->user->count();
	}
	function get_user_list(){
		$list=array();
		$this->where('id',1)->get();		
		$this->get();
		$this->user->get();
		foreach($this->user as $user){
			array_push($list,array($user->id,humanize($user->username),anchor('branches/delete','Delete','class="table_button"')));
		}
		return $list;
	}
	function set_user_list($id){
		$this->where('id',$id)->get();
	}
	function get_client_count(){
		return $this->client->count();
	}
	function get_client_list($per_page,$page){
		$list=array();
		$this->client->get($per_page,$page);
		foreach($this->client as $client){
			array_push($list,array($client->id,$client->NAMA_PELANGGAN));
		}
		return $list;
	}
	function set_client_list($id){
		$this->pagination_attributes['base_url'] 	= base_url() . '/index.php/branches/show_clients/' . $id;
		$this->pagination_attributes['total_rows'] 	= $this->get_client_count();
		$this->pagination_attributes['per_page'] 	= 10;
		$this->obj->pagination->initialize($this->pagination_attributes);
	}
}