<?php
$this->load->view('common/header');
	if(empty($list)){
		echo '<div>The list is empty</div>';
	}else{
		$this->lib_table->set_alignment(1,'center');
		echo $this->lib_table->set_table('services',array('Name','Edit'),$list);
	}
	$this->lib_table_manager->create_table($navigator);
$this->load->view('common/footer');