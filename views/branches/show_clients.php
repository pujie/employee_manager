<?php
echo $css;
echo $menu;
echo $title;
echo $this->pagination->create_links();
echo $this->lib_table_manager->create_table($list);
echo $this->pagination->create_links();