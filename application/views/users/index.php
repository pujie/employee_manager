<?php
	$header_data=array('username'=>humanize($user_data->get_user()),'row_count'=>$users->get_user_count());
	$this->load->view('common/header',$header_data);
	echo $user_data->get_pagetitle();
	echo $user_data->get_title();
	$head=array(array('colspan'=>'1','val'=>'ID'),array('colspan'=>'1','val'=>'NAME'),array('colspan'=>'1','val'=>'EMAIL'),
	array('colspan'=>'1','val'=>'MODULES'),array('colspan'=>'1','val'=>'BRANCH'),array('colspan'=>'2','val'=>'ACTION'),);
	$this->lib_table->set_multi_alignment(array('0'=>'center','3'=>'center','4'=>'center','5'=>'center','6'=>'center',));
	echo $this->lib_table->set_table2('client',$head,$list);
	$this->pagination->initialize($pagination);
	echo 'Goto Page ' . $this->pagination->create_links();
	$footer_data=array('navigator'=>($user_data->get_navigator()));
	$this->load->view('common/footer', $footer_data);
