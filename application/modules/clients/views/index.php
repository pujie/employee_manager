<?php 
$header_data=array('username'=>$this->user_data->get_user());
$this->load->view('common/header',$header_data);
$this->load->view('navigator');
echo $this->user_data->get_pagetitle();
$this->lib_table->set_alignment(5,'center');
echo $this->lib_table->set_table('client',$head,$body);
echo '<div class=pagination>';
echo $this->pagination->create_links();
echo '</div>';
$footer_data=array('navigator'=>$this->user_data->get_navigator());
$this->load->view('common/footer',$footer_data);