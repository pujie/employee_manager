<?php
$this->load->view('common/header');
echo '<h1>Login</h1>';
echo '<div id=login>';
echo form_open('front_page/login_handler');
$name_label	=	array('class'=>'tableless_login_label','name'=>'namelabel');
$name		=	array('class'=>'tableless_login_input','name'=>'name');
$pass_label	=	array('class'=>'tableless_login_label','name'=>'passlabel');
$password	=	array('class'=>'tableless_login_input','name'=>'password');
echo form_label('Name','name',$name_label); 
echo form_input($name ) . '<br>';
echo form_label('Password','password',$pass_label);
echo form_password($password) . '<br>';
echo form_submit('submit','Login');
echo form_close();
echo '</div>';
$this->load->view('common/footer');
