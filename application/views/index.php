<?php
echo $title;
echo 'You are member of ' . $this->data['branch'] . ' branch<br>';
echo 'You can access ' . $this->data['modules'] . ' module(s)<br>';

// $this->lib_table_manager->create_table($user_data->get_navigator());
// $this->menu->links($user_data->get_links());
// $list=$this->list_modules();
echo $this->config->item('logout_link');
