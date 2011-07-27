<?php
echo $css;
echo $menu;
echo $title;
echo $this->lib_table_manager->set_heading(array('Id','City','Edit','Delete','Clients'));
echo $this->lib_table_manager->create_table($list);
echo $this->lib_table_manager->create_table($navigator);
$this->menu->links($links);