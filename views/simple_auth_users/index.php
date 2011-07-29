<?php
	echo $css;
	echo $title;
	$this->lib_table_manager->set_heading($heading);
	echo 'User count: ' . $users->get_user_count();
	$this->lib_table_manager->create_table($users->get_user_list());
	$this->lib_table_manager->create_table($navigator);
	$this->menu->links($links);