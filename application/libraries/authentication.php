<?php
class authentication{
var $obj;
	function __construct(){
		$this->obj = & get_instance();
	}
	function is_authenticated(){
		if($this->obj->simple_auth->is_logged_in()){
			// $this->obj->load->view('front_page/login',$this->data);
			return true;
		}
		else
		{
			$this->obj->load->view('front_page/not_loged_in');
			// redirect('UserManager');
			return false;
		}

	}
}