<?php
echo '<h1>Login</h1>';
echo form_open('front_page/login_handler');
echo '<dl>';
echo '<dt>Name</dt><dt>' . form_input('name','name') . '</dt>';
echo '</dl>';
echo '<dl>';
echo '<dt>Password</dt><dt>' . form_input('password','password') . '</dt>';
echo '</dl>';
echo form_submit('submit','Login');
echo form_close();