<?php
// echo $css;
$this->load->view('navigator');
echo $this->user_data->get_title();
echo $this->pagination->create_links();
$this->lib_table_manager->create_table($list);
echo $this->pagination->create_links();
echo $this->lib_table_manager->create_table($this->user_data->get_navigator());
echo $this->menu->links($this->user_data->get_links());