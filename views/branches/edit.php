<?php
echo $css;
echo $menu;
echo $title;
if(empty($list)){
	echo 'no data is present ..<br>';
}
else
{
echo $this->lib_table_manager->create_table($list);
}
echo $this->lib_table_manager->create_table($navigator);
