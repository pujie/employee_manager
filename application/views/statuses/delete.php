<?php
$this->load->view('common/header');
?>
<script type='text/javascript'>
$(document).ready(function(){
	$('#confirm').dialog(
	{
	'buttons':{'Yes':function()
		{
			// window.location	=	'<?php echo base_url(); ?>' + 'index.php/statuses/delete_handler/' + '<?php echo $id;?>';
		},
		'No':function()
		{
			$(this).dialog('close');
		}},
	'hide':'explode'
	}
	);
});
</script>
<div id='confirm'>
Are you sure want to delete this user ?
</div>

<?php
	$this->load->view('common/footer');
?>
