<?php
$this->load->view('common/header');
echo $css;
echo $user->get_title();
echo $user->get_pagetitle();
echo humanize($user->get_user()) . ', there are ' . $branches->get_branch_count() . ' branches <p>';
$this->lib_table->set_alignment(2,'center');
$this->lib_table->set_alignment(3,'center');
$this->lib_table->set_alignment(4,'center');
$this->lib_table->set_alignment(5,'center');
$head=array('Id','City','Edit','Delete','User','Clients');
echo $this->lib_table->set_table('branch',$head,$branches->get_branch_list());
echo $this->lib_table_manager->create_table($user->get_navigator());
$this->load->view('common/footer');
