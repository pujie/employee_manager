<?php
$header_data=array('username'=>humanize($user_data->get_user()));
$this->load->view('common/header',$header_data);
echo $user_data->get_pagetitle();
echo $user_data->get_title();
echo 'There are ' . $branch_user->get_branches_count() . ' branches';
echo $this->lib_table->set_table('branch',array('Id','Name'),$branch_user->get_branches_list());
$footer_data=array('navigator'=>$user_data->get_navigator());
$this->load->view('common/footer',$footer_data);
