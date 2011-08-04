<?php
$this->load->view('common/header');
?>
<script type="text/javascript">
$(document).ready(function(){
	$(".button").button();
});
</script>
<?php
echo $title;
$this->lib_table_manager->create_table($this->user_data->get_navigator());
$this->load->view('common/footer');
