<?php
echo $this->config->item('css');
echo $menu;
echo $title;
$this->lib_table_manager->set_heading(array('Id','Name','Edit','Uninstall'));
$this->lib_table_manager->create_table($list);
$this->menu->links($navigator);