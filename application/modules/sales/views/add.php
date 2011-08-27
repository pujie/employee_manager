<?php $this->load->view('common/common');?>
<script type="text/javascript">
	$(document).ready(function(){
		$('#user').combobox();
		});
</script>
	
<div class="demo">

<div class="ui-widget">
<?php echo form_open('sales/add_handler');?>
	<label>Menambahkan dari User yang telah ada: </label>
	<select id="user" name="user">
		<option value="">Select one...</option>
		<?php 
		foreach($users as $user){
			echo '<option value=' . $user->id . '>' . $user->username . '</option>';
		}
		?>
	</select>
	<?php echo form_submit('save','Simpan');?>
	<?php echo form_close();?>
</div>

</div><!-- End demo -->



<div class="demo-description">
<p>A custom widget built by composition of Autocomplete and Button. You can either type something into the field to get filtered suggestions based on your input, or use the button to get the full list of selections.</p>
<p>The input is read from an existing select-element for progressive enhancement, passed to Autocomplete with a customized source-option.</p>
</div><!-- End demo-description -->