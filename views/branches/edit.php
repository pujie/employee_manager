<?php
echo $css;
echo $user->get_title();
echo $user->get_pagetitle();
echo form_open('branches/edit_handler');
echo form_hidden('id',$branch->id);
echo form_input('nama',$branch->name);
echo form_submit('save','Save');
echo form_close();
$this->lib_table_manager->create_table($user->get_navigator());
$this->menu->links($user->get_links());
