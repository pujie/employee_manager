<?php
echo $css;
echo $menu;
echo $title;
echo form_open('simple_auth_users/edit_handler');
echo form_hidden('id',$id);
echo '<dl>Name<dt>' . form_input($userbefore) . '</dt></dl>';
echo '<dl>Password<dt>' . form_password($passwordbefore) . '</dt></dl>';
echo '<dl>Email<dt>' . form_input($emailbefore) . '</dt></dl>';


echo form_submit('submit','Edit User') . '';
echo form_close();