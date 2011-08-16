<?php
	$header_data=array('username'=>$user_data->get_user());
	$this->load->view('common/header',$header_data);
	$this->lib_table->set_head_object(array('ID','NAME'));//override the header
	echo $this->lib_table->set_table('client',array('id','Name'),$clients);
	echo $this->pagination->create_links();
	$footer_data=array('navigator'=>$navigator);	
	$this->load->view('common/footer',$footer_data);