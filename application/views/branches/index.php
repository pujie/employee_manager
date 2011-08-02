<?php
echo $css;
echo $user->get_title();
echo $user->get_pagetitle();
echo humanize($user->get_user()) . ', there are ' . $branches->get_branch_count() . ' branches <p>';
echo $this->lib_table_manager->set_heading(array('Id','City','Edit','Delete','User','Clients'));
echo $this->lib_table_manager->create_table($branches->get_branch_list());
echo $this->lib_table_manager->create_table($user->get_navigator());
$this->menu->links($user->get_links());