<?php
	// echo $css;
	echo $user->get_pagetitle();
	echo $user->get_title();
	$this->lib_table_manager->set_heading($heading);
	echo 'User count: ' . $users->get_user_count();
	$this->lib_table_manager->create_table($users->get_user_list());
	$this->lib_table_manager->create_table($user->get_navigator());
	$this->menu->links($user->get_links());