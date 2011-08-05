<?php 
$this->load->view('common/header');
$this->load->view('navigator');
echo $this->user_data->get_pagetitle();
$this->lib_table->set_alignment(5,'center');
echo $this->lib_table->set_table('client',$head,$body);
echo '<div class=pagination>';
echo $this->pagination->create_links();
echo '</div>';
$this->lib_table_manager->create_table($this->user_data->get_navigator());
$this->load->view('common/footer');