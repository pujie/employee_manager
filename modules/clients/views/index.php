<?php
echo $css;
echo $title;
echo $this->pagination->create_links();
$this->lib_table_manager->create_table($list);
echo $this->pagination->create_links();
echo $this->lib_table_manager->create_table($navigator);
echo $this->menu->links($links);