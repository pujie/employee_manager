<?php
echo $standard_css;
echo $menu;
if($success){
	// redirect('index');
	// echo $navigator;
	echo $title;
	echo $this->lib_table_manager->create_table($navigator);
	echo $this->menu->links($links);
}
else{
	echo 'not success';
}