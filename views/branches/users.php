<?php
echo $css;
echo $title;
if(empty($list)){
	echo 'no data is present ..<br>';
}
else
{
echo $this->lib_table_manager->set_heading(array('Id','Name','Edit','Delete'));
echo $this->lib_table_manager->create_table($list);
}
echo $this->lib_table_manager->create_table($navigator);
$this->menu->links($links);