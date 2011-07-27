<?php
echo $css;
echo $menu;
echo $title;
echo $this->pagination->create_links();
$this->lib_table_manager->create_table($list);
echo $this->pagination->create_links();
echo $this->menu->links($modules);