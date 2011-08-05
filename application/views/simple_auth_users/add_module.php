<?php
$this->load->view('common/header');
echo $title;
echo form_open('simple_auth_users/add_module_handler');
echo form_hidden('id',$this->uri->segment(3));
echo '<h2>Available modules for ' . humanize($user->username) . ':</h2>';
$head=array('Module','Add');
$list=array();
foreach($modules as $module){
	array_push($list,array($module->name,form_checkbox('module',$module->id,FALSE)));
}
echo $this->lib_table->set_table('module',$head,$list);
echo '<br>' . form_submit('save','Save');
echo form_close();
echo $this->lib_table_manager->create_table($user_data->get_navigator());
$this->load->view('common/footer');
