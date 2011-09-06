<?php
$this->load->view('common/header');
$this->load->view('activity_logs/navigator');
$this->lib_table->set_alignment(2,'center');
$this->lib_table->set_alignment(3,'center');
echo $this->lib_table->set_table('log',$header,$list);
echo $this->pagination->create_links();
$this->lib_table_manager->create_table($navigator);
$this->load->view('common/footer');