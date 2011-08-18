<?php
$header_data=array('username'=>$user_data->get_user());
$this->load->view('common/header',$header_data);
$head=array(array('colspan'=>'1','val'=>'ID'),array('colspan'=>'1','val'=>'NAME'),array('colspan'=>'1','val'=>'DESCRIPTION'),
array('colspan'=>'2','val'=>'ACTION'));
$this->lib_table->set_multi_alignment(array('0'=>'center','3'=>'center','4'=>'center',));

echo $this->lib_table->set_table2('department',$head,$list);
$footer_data=array('navigator'=>array(array(anchor('/','Home','class="button"'),anchor('front_page/logout','Logout','class="button"'))));
$this->load->view('common/footer',$footer_data);
