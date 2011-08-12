<?php
$this->load->view('common/header');
echo $title;
echo form_open('simple_auth_users/add_handler');
echo form_label('Name','name',$name_label); 
echo form_input($name ) . '<br>';
echo form_label('Email','password',$email_label);
echo form_input($email) . '<br>';
echo form_label('Password','password',$pass_label);
echo form_password($password) . '<br>';
echo form_submit('submit','Login');
echo form_close();
$this->load->view('common/footer');