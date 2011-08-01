<?php
echo $css;
echo $title;
echo form_open('simple_auth_users/add_module_handler');
echo form_hidden('id',$this->uri->segment(3));
echo '<h2>Choose module (s):</h2>';
foreach($modules as $module){
echo form_checkbox('modules[]',$module->id,FALSE) . $module->name;
}
echo '<br>' . form_submit('save','Save');
echo form_close();
echo $this->lib_table_manager->create_table($navigator);
$this->menu->links($links);