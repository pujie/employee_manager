<?php
echo 'Add Branch for ' . humanize($user->username) . '<br>';
foreach($user->branch as $branch){
echo $branch->name . '<br>';
}
echo '<div>--</div>';
$branch=new Branch;
// $branch->where_not_in('name',array('Surabaya'));
$branch->where_not_in('name',$user->branch->name);
$b=$branch->get();
foreach($branch as $brc){
echo $brc->id . ':' . $brc->name . '<br>';
}

foreach($b as $body){
echo $body->name . ', ';
}
$head=array(array('id','name'));
echo $this->lib_table->set_table('branch',$head,$body);