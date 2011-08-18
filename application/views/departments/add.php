<?php
$header_data=array('username'=>$user_data->get_user());
$this->load->view('common/footer',$header_data);
		echo form_open('departments/add_handler',$header_data);
		echo form_input('name','Name');
		echo form_input('description','Description');
		echo form_submit('save','Save');
		echo form_close();
$footer_data=array('navigator'=>array(array(anchor('/','Home','class="button"'),anchor('front_page','Logout','class="button"'))));
$this->load->view('common/footer',$footer_data);
