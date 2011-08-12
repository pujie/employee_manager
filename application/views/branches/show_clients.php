<?php
	$this->load->view('common/header');
	$this->lib_table->set_head_object(array('ID','NAME'));//override the header
	// echo $this->lib_table->extract_object($clients,array('id','name'));
	echo $this->lib_table->set_table('client',array('id','Name'),$clients);
	echo $this->pagination->create_links();
	$this->lib_table_manager->create_table($navigator);
	$this->load->view('common/footer');