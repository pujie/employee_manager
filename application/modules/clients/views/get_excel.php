<?php
		$filename='clients.xls';
		$this->output->set_header('Content-type: application/ms-excel');
		$this->output->set_header('Content-Disposition: attachment; filename='.$filename);
		echo $this->lib_table->set_table('client',$head,$client_list);
