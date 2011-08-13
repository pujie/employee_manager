<?php
// echo $menu;
$this->load->view('common/header');
echo $title;
echo form_open('users/edit_handler');
echo form_hidden('id',$id);
echo '<dl>Name<dt>' . form_input($userbefore) . '</dt></dl>';
echo '<dl>Password<dt>' . form_password($passwordbefore) . '</dt></dl>';
echo '<dl>Email<dt>' . form_input($emailbefore) . '</dt></dl>';
echo form_submit('submit','Save') . '';
echo form_close();
$this->lib_table_manager->create_table($this->user->get_navigator());
$this->load->view('common/footer');
