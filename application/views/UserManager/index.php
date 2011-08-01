<?php
echo $css;
if($success){
	echo $title;
	echo 'Branch : ' . $user_branch->name;
	echo $this->lib_table_manager->create_table($navigator);
	echo $this->menu->links($links);
}
else{
	echo 'not success';
}