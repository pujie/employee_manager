<?php
if($success){
	echo $user->get_title();
	echo '<div>Branch : ' . $user_branch->name . '</div>';
	echo $this->lib_table_manager->create_table($user->get_navigator());
	echo $this->menu->links($user->get_links());
}
else{
	echo 'not success';
}