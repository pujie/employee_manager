<?php
	$header_data=array('username'=>Humanize($user_data->get_user()),'row_count'=>$branches->get_branch_count());
	$this->load->view('common/header',$header_data);
	echo $user_data->get_title();
	$alignment=array('0'=>'center','2'=>'center','3'=>'center','2'=>'center','5'=>'center','4'=>'center');
	$this->lib_table->set_multi_alignment($alignment);
	$head=array(array('colspan'=>'1','val'=>'ID'),array('colspan'=>'1','val'=>'City'),array('colspan'=>'1','val'=>'USER'),array('colspan'=>'1','val'=>'CLIENTS'),array('colspan'=>'2','val'=>'ACTION'));
	echo $this->lib_table->set_table2('branch',$head,$branches->get_branch_list());
	$footer_data=array('navigator'=>$user_data->get_navigator());
	$this->load->view('common/footer',$footer_data);
