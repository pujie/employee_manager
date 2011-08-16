<?php
$header_data=array('username'=>humanize($user_data->get_user()));
$this->load->view('common/header',$header_data);
echo $title;
echo form_open('users/edit_handler');
echo form_hidden('id',$id);
echo '<dl>Name<dt>' . form_input($userbefore) . '</dt></dl>';
echo '<dl>Password<dt>' . form_password($passwordbefore) . '</dt></dl>';
echo '<dl>Email<dt>' . form_input($emailbefore) . '</dt></dl>';
echo form_submit('submit','Save') . '';
echo form_close();
$footer_data=array('navigator'=>$this->user->get_navigator());
$this->load->view('common/footer',$footer_data);
