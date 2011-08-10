<?php
$this->load->view('common/header');
echo $user->get_title();
echo $user->get_pagetitle();
echo 'Number of users: ' . $branch->get_user_count();
$this->lib_table->set_alignment(0,'center');
$this->lib_table->set_alignment(2,'center');
echo $this->lib_table->set_table('user',array('Id','Name','Delete'),$branch->get_user_list());
$this->lib_table_manager->create_table($user->get_navigator());
$this->load->view('common/footer');
