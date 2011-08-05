<?php
$this->load->view('common/header');
$this->lib_table->set_head_object(array('ID','NAME'));//override the header
echo $this->lib_table->extract_object($clients,array('id','NAMA_PELANGGAN'));
$this->lib_table_manager->create_table($user->get_navigator());
$this->load->view('common/footer');