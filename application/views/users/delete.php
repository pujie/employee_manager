<?php
$this->load->view('common/header');
?>
<script type='text/javascript'>
$(document).ready(function(){
	$('#confirm').dialog(
	{
	'buttons':{'Yes':function()
		{
			window.location	=	'<?php echo base_url(); ?>' + 'index.php/users/delete_handler/' + '<?php echo $id;?>';
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
	// $user	=	new User;
	// $user->where('id',$this->uri->segment(3))->get();
	// $user->delete();
	// redirect('Users');
	$this->load->view('common/footer');
?>
