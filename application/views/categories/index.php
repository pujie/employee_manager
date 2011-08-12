<?php
	$this->load->view('common/header');
	echo $this->lib_table->set_table('categories',array('NAME','EDIT'),$list);
	$this->lib_table_manager->create_table($navigator);
	$this->load->view('common/footer');
