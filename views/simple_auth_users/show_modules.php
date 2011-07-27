<?php
echo $css;
echo $menu;
echo $title;

$this->lib_table_manager->set_heading(array('id','Module'));
$this->lib_table_manager->create_table($list);
echo anchor($last_url,'Last URL');