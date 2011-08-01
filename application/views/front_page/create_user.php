<?php
echo $standard_css;
echo $menu;
echo $title;
echo form_open('front_page/create_user_handler');
echo '<dl>Name<dt>' . form_input('username',set_value('user name')) . '</dt></dl>';
echo '<dl>Password<dt>' . form_password('userpassword') . '</dt></dl>';
echo '<dl>Email<dt>' . form_input('email',set_value('email@domain')) . '</dt></dl>';
echo form_submit('submit','Create User') . '';
echo form_close();