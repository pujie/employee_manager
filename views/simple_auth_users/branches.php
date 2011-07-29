<?php
echo $css;
echo $user->get_title();
echo 'There are ' . $branch_user->get_branches_count() . ' branches';
$this->lib_table_manager->create_table($branch_user->get_branches_list());
$this->lib_table_manager->create_table($user->get_navigator());
$this->menu->links($user->get_links());
echo anchor('simple_auth_users','Back to Users');