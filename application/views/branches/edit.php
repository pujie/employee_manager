<?php
	$header_data=array('username'=>$user_data->get_user());
	$this->load->view('common/header',$header_data);
	echo $css;
	echo $user_data->get_title();
	echo $user_data->get_pagetitle();
	echo form_open('branches/edit_handler');
	echo form_hidden('id',$branch->id);
	echo 'Name' . form_input('nama',$branch->name);
	echo form_submit('save','Save');
	echo form_close();
	$footer_data=array('navigator'=>$user_data->get_navigator());
	$this->load->view('common/footer',$footer_data);
