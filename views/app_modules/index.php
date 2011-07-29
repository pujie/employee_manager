<?php
echo $user->get_title();
echo humanize($user->get_user());
$this->lib_table_manager->set_heading(array('Id','Name','Edit','Uninstall'));
$this->lib_table_manager->create_table($list);
$this->lib_table_manager->create_table($this->user->get_navigator());
$this->menu->links($user->get_links());