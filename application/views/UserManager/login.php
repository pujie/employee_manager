<?php
echo $title;
echo form_open('UserManager/login_handler');
echo '<dl>';
echo '<dt>Name</dt><dt>' . form_input('name','name') . '</dt>';
echo '</dl>';
echo '<dl>';
echo '<dt>Password</dt><dt>' . form_input('password','password') . '</dt>';
echo '</dl>';
echo form_submit('submit','Login');
echo form_close();