<?php
echo $css;
echo $menu;
echo $title;
echo form_open('Simple_auth_users/add_handler');
echo '<dl>User Name<dt>' . form_input('username','name') . '</dt></dl>';
echo '<dl>User Email<dt>' . form_input('email','email') . '</dt></dl>';
echo '<dl>User Password<dt>' . form_password('userpassword','password') . '</dt></dl>';

echo form_submit('submit','Add User') . '';
echo form_close();