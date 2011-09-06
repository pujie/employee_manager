<?php
echo form_open('activity_logs/find_handler');
?>
Search
<input type='text' name='search'>
<input type='submit' name='submit' value='Find'>
<input type='submit' name='resetsubmit' value='Reset'>
<?php
echo form_close();
?>