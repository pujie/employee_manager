<?php
echo $user->get_title();
echo $user->get_pagetitle();
echo $user->get_user();
echo '<div>Dude, No branch add right now</div>';
$this->lib_table_manager->create_table($user->get_navigator());
$this->menu->links($user->get_links());