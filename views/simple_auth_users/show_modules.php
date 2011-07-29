<?php
echo $css;
echo $user->get_title();

$this->lib_table_manager->set_heading(array('id','Module'));
echo 'The modules are: ' . $module_user->get_modules_count();
$this->lib_table_manager->create_table($module_user->get_modules_list());
echo $this->lib_table_manager->create_table($user->get_navigator());
$this->menu->links($user->get_links());
