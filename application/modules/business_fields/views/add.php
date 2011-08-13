<?php
$this->load->view('common/header');
echo form_open('business_fields/add_handler/' . $id);
$field_label	=	array(
	'class'	=>	'tableless_label'
);
$field_array	=	array(
	'name'	=>	'field',
	'class'	=>	'tableless_input'
);
echo form_label('Business Field','field',$field_label);
echo form_input($field_array) . '<br>';
echo form_submit('Save','save');
echo form_close();
$this->lib_table_manager->create_table($navigator);
$this->load->view('common/footer');