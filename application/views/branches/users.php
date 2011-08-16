<?php
	$header_data=array('username'=>$user_data->get_user());
	$this->load->view('common/header',$header_data);
	echo $user_data->get_title();
	echo $user_data->get_pagetitle();
	echo 'Number of users: ' . $branch->get_user_count();
	$this->lib_table->set_alignment(0,'center');
	$this->lib_table->set_alignment(2,'center');
	echo $this->lib_table->set_table('user',array('Id','Name','Delete'),$branch->get_user_list());
	$footer_data=array('navigator'=>$user_data->get_navigator());
	$this->load->view('common/footer',$footer_data);
