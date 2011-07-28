<?php
echo $css;
echo $title;
echo form_open('branches/edit_handler');
echo form_hidden('id',$branch->id);
echo form_input('nama',$branch->name);
echo form_submit('save','Save');
echo form_close();
echo $this->lib_table_manager->create_table($navigator);
$this->menu->links($links);
