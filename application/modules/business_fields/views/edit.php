<?php
$this->load->view('common/header');
echo form_open('business_fields/edit_handler/' . $id);
echo form_hidden('id',$fields->id);
echo form_label('business field','name');
echo form_input('name',$fields->name) . '<br>';
echo form_submit('save','Save');
echo form_close();
echo $this->lib_table_manager->create_table($navigator);
$this->load->view('common/footer');