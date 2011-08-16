<?php
$header_data=array('username'=>humanize($user->get_user()));
$this->load->view('common/header',$header_data);
echo $user->get_title();
echo $user->get_pagetitle();
echo form_open('branches/add_handler');
echo 'Name : ' . form_input('name');
echo form_submit('save','Save');
echo form_close();
$footer_data=array('navigator'=>$user->get_navigator());
$this->load->view('common/footer',$footer_data);