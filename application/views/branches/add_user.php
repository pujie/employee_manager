<?php
$this->load->view('common/header');// echo $user->get_title();
echo form_open('branches/add_user_handler');
echo form_hidden('branch_id',$branch_id);
echo '<dl>User Name<dt>' . form_dropdown('user_id',$users) . '</dt></dl>';

echo form_submit('submit','Add User') . '';
echo form_close();
echo $this->lib_table_manager->create_table($navigator);
$this->load->view('common/footer');