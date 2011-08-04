<?php
$this->load->view('common/header');
echo $user->get_title();
echo humanize($user->get_user());
$header=array('Id','Name','Edit','Uninstall');
$this->lib_table->set_alignment(2,'center');
$this->lib_table->set_alignment(3,'center');
echo $this->lib_table->set_table('modules',$header,$list);
$this->lib_table_manager->create_table($this->user->get_navigator());
$this->load->view('common/footer');
