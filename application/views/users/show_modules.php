<?php
$header_data=array('username'=>$user_data->get_user());
$this->load->view('common/header',$header_data);
echo $user_data->get_title();
$header=array('id','Module');
echo 'The modules are: ' . $module_user->get_modules_count();
echo $this->lib_table->set_table('modules',$header,$module_user->get_modules_list());
$footer_data=array('navigator'=>$user_data->get_navigator());
$this->load->view('common/footer',$footer_data);
