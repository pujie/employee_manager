<?php
echo form_open('clients/find_handler');
?>
Search
<input type='text' name='search'>
<input type='submit' name='submit' value='Find'>
<input type='submit' name='resetsubmit' value='Reset'>
<a href='clients/get_excel' class='button'><img height=10 src="<?php echo base_url();?>media/excel_icon.jpg"></a>
<?php
echo form_close();
?>