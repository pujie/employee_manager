<?php
echo $standard_css;
echo $menu;
echo $title;

echo form_open('UserManager/change_password_handler');
echo '<dl>New Password<dt>' . form_password('new_password') . '</dt></dl>';
echo '<dl>Confirm New Password<dt>' . form_password('confirm_password') . '</dt></dl>';
echo form_submit('submit','Change Password') . '';
echo form_close();