<?php
$header_data=array('username'=>$user_data->get_user());
$this->load->view('common/header',$header_data);
echo $title;
echo form_open('users/add_handler');
echo form_label('Name','name',$name_label); 
echo form_input($name ) . '<br>';
echo form_label('Email','password',$email_label);
echo form_input($email) . '<br>';
echo form_label('Password','password',$pass_label);
echo form_password($password) . '<br>';
echo form_submit('submit','Save');
echo form_close();
$footer_data=array('navigator'=>$navigator);
$this->load->view('common/footer',$footer_data);