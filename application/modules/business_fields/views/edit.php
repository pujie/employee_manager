<?php
$this->load->view('common/header',array('username'=>Humanize($user_data->get_user())));
echo form_open('business_fields/edit_handler/' . $id);
echo form_hidden('id',$fields->id);
echo form_label('business field','name');
echo form_input('name',$fields->name) . '<br>';
echo form_submit('save','Save');
echo form_close();
$this->load->view('common/footer',array('navigator'=>$navigator));