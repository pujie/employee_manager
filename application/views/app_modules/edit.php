<?php
// echo $this->config->item('css');
$this->load->view('common/header');
echo $user->get_title();
echo $user->get_user();
echo form_open('app_modules/edit_handler');
echo form_hidden('id',$module->id) . '<br>';
echo 'Name' . form_input('name',$module->name) . '<br>';
echo 'URL' . form_input('url',$module->url) . '<br>';
echo form_submit('save','Save');
echo form_close();
$this->lib_table_manager->create_table($user->get_navigator());
$this->load->view('common/footer');