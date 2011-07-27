<?php
	echo form_open('clients/edit_handler');
	echo form_submit('save','Save');
	$this->lib_table_manager->create_table($list);
	echo form_close();
