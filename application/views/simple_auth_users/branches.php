<?php
$this->load->view('common/header');
echo $user->get_pagetitle();
echo $user->get_title();
echo 'There are ' . $branch_user->get_branches_count() . ' branches';
$this->lib_table_manager->create_table($branch_user->get_branches_list());
$this->lib_table_manager->create_table($user->get_navigator());
$this->load->view('common/footer');
