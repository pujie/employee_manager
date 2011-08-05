<?php
$this->load->view('common/header');
?>
<script type='text/javascript'>
	$(document).ready(function(){
		$('#dialog').dialog({
			buttons:{
				yes:function(){
				$(location).attr('href','<?php echo base_url();?>index.php/branches/delete_handler/<?php echo $this->uri->segment(3)?>');
				$(this).dialog('close');
				},
				no:function(){
				$(location).attr('href','<?php echo base_url();?>index.php/branches');
				$(this).dialog('close');
				}
			},
			hide:'explode'
		});
	});
</script>
<div id='dialog'>
Are you sure want to delete this record ?
</div>
<?php
$this->load->view('common/footer');
?>
