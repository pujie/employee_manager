<?php
echo $css;
echo $user->get_title();
echo $user->get_pagetitle();
echo $this->lib_table_manager->set_heading(array('Id','Name','Edit','Delete'));
echo 'Number of users: ' . $branch->get_user_count();
echo $this->lib_table_manager->create_table($branch->get_user_list());
$this->lib_table_manager->create_table($user->get_navigator());
$this->menu->links($user->get_links());