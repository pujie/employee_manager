<?php
$this->load->view('common/header');
?>
<script type='text/javascript'>
$(document).ready(function(){
	$('#confirm').dialog(
	{
	'buttons':{'Yes':function()
		{
			$(this).dialog('close');
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
