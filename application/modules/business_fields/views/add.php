<?php
$this->load->view('common/header',array('username'=>Humanize($user_data->get_user())));
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
$this->load->view('common/footer',array('navigator'=>$navigator));