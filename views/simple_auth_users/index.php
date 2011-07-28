<?php
	echo $css;
	echo $title;
	$this->lib_table_manager->set_heading($heading);
	$this->lib_table_manager->create_table($list);
	$this->lib_table_manager->create_table($navigator);
	$this->menu->links($links);