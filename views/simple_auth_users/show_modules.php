<?php
echo $css;
echo $title;

$this->lib_table_manager->set_heading(array('id','Module'));
$this->lib_table_manager->create_table($list);
echo $this->lib_table_manager->create_table($navigator);
$this->menu->links($links);
// echo anchor($last_url,'Last URL');