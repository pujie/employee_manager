<?php $this->load->view('common/table');?>
<script type="text/javascript">
	$(document).ready(function(){
		$("#clienst").dataTable();
		$("a.button").button();
	})
</script>

<?php
$this->load->view('navigator');
echo $this->user_data->get_pagetitle();
echo $this->lib_table->set_table('client',$head,$body);
echo $this->pagination->create_links();
$this->lib_table_manager->create_table($this->user_data->get_navigator());
$this->menu->links($this->user_data->get_links());