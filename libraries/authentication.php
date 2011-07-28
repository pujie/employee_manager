<?php
class authentication{
var $obj;
	function __construct(){
		$this->obj = & get_instance();
	}
	function is_authenticated(){
		if($this->obj->simple_auth->is_logged_in()){
			// $this->obj->load->view('UserManager/login',$this->data);
			return true;
		}
		else
		{
			$this->obj->load->view('UserManager/not_loged_in');
			// redirect('UserManager');
			return false;
		}

	}
}