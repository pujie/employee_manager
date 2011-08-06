<?php
$this->load->view('common/header');
?>
<script type='text/javascript'>
$(document).ready(function(){
	$('#not_logged_in').dialog({
		buttons:{
			ok:function(){$(this).dialog('close');},
			login:function(){
				$(location).attr('href','<?php echo base_url();?>index.php/front_page/login');
				$(this).dialog('close');
			}
		},
		hide:'explode',
		title:'Login not success'
	});
});
</script>
<div id="not_logged_in">You are not authenticated</div>
<?php
echo anchor('front_page/login','Enter here to Log in','class="button"');
$this->load->view('common/footer');