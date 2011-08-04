<?php
$this->load->view('common/header');
echo $user->get_title();
$header=array('id','Module');
echo 'The modules are: ' . $module_user->get_modules_count();
echo $this->lib_table->set_table('modules',$header,$module_user->get_modules_list());
$this->lib_table_manager->create_table($user->get_navigator());
$this->load->view('common/footer');
