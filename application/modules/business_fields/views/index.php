<?php
$this->load->view('common/header');
$this->lib_table->set_alignment(1,'center');$this->lib_table->set_alignment(2,'center');
echo $this->lib_table->set_table('fields',array('Name','Edit','Delete'),$fields);
echo $this->pagination->create_links();
$this->lib_table_manager->create_table($navigator);
$this->load->view('common/footer');