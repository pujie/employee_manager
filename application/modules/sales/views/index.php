<?php
$this->load->view('common/header');
$this->lib_table->set_alignment('2','center');
echo $this->lib_table->set_table('sales',array('Id','Name','Action'),$list);

$this->load->view('common/footer');