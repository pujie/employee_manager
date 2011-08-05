<?php
$this->load->view('common/header');
echo $user->get_title();
echo $user->get_pagetitle();
echo form_open('branches/add_handler');
echo 'Name : ' . form_input('name');
echo form_submit('save','Save');
echo form_close();
$this->lib_table_manager->create_table($user->get_navigator());
$this->load->view('common/footer');