<?php
$this->load->view('common/header');
echo 'Branches available for ' . humanize($user->username) . '<br>';
$branch=new Branch;
$branch->where_not_in('name',$user->branch->name);
$b=$branch->get();
$list=array();
foreach($b as $body){
	array_push($list,array($body->name, form_checkbox('branch',$body->id,FALSE)));
}
$head=array('Branch Name','Add');
echo $this->lib_table->set_table('branch',$head,$list);
echo $this->lib_table_manager->create_table($user_data->get_navigator());
$this->load->view('common/footer');
