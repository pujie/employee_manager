<?php
$this->load->view('common/header',array('username'=>Humanize($user_data->get_user())));
$this->lib_table->set_multi_alignment(array('0'=>'center','2'=>'center','3'=>'center'));
echo $this->lib_table->set_table2('fields',array(array('colspan'=>'1','val'=>'ID'),array('colspan'=>1,'val'=>'NAME'),array('colspan'=>'2','val'=>'ACTION')),$fields);
echo $this->pagination->create_links();
$this->load->view('common/footer',array('navigator'=>$navigator));