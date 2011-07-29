<?php
	echo $css;
	echo $user->get_title();
	echo $user->get_pagetitle();
	// echo '<div><strong>Total Rows:' . $total_rows . '</strong></div><p>';
	echo '<div><strong>Total Rows:' . $branch_client->get_client_count() . '</strong></div><p>';
	echo $this->pagination->create_links();
	$this->lib_table_manager->create_table($branch_client->get_client_list(10,$this->uri->segment(4)));
	echo $this->pagination->create_links();
	$this->lib_table_manager->create_table($user->get_navigator());
	$this->menu->links($user->get_links());