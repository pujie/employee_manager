<?php
$this->load->view('common/header');
echo 'Branches available for ' . humanize($user->username) . '<br>';
$branch=new Branch;
$branch->where_not_in('name',$user->branch->name);
$b=$branch->get();
echo form_open('users/add_branch_handler/' . $this->uri->segment(3));
echo form_hidden('id',$this->uri->segment(3));
$list=array();
foreach($b as $body){
	array_push($list,array($body->name, form_checkbox('branch',$body->id,FALSE)));
}
$head=array('Branch Name','Add');
echo $this->lib_table->set_table('branch',$head,$list);
echo form_submit('save','save');
echo form_close();
echo $this->lib_table_manager->create_table($user_data->get_navigator());
$this->load->view('common/footer');
