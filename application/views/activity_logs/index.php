<?php
$this->load->view('common/header');
echo $this->lib_table->set_table('log',array('ID','Description','Date','User Name'),$list);
$this->lib_table_manager->create_table($navigator);
$this->load->view('common/footer');