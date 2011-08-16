<?php
$header_data=array('username'=>humanize($user->get_user()));
$this->load->view('common/header',$header_data);
echo $user->get_title();
$header=array('Id','Name','Edit','Uninstall');
$this->lib_table->set_multi_alignment(array('0'=>'center','2'=>'center','3'=>'center'));
echo $this->lib_table->set_table('modules',$header,$list);
$footer_data=array('navigator'=>$this->user->get_navigator());
$this->load->view('common/footer',$footer_data);
