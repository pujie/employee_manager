<?php
	
	$this->load->view('common/header');
	echo 'Verify the data before import, ...';
	$this->lib_table_manager->create_table($this->user_data->get_navigator());
	echo $this->lib_table->set_table('excel',$head,$body);
	$this->load->view('common/footer');
