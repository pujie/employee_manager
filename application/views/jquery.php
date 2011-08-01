<html>
<head>
<script type="text/javascript" src="<?php echo $this->config->item('base_url')?>scripts/jquery-1.6.2.js"></script>
<script type="text/javascript" src="<?php echo $this->config->item('base_url')?>scripts/global.js"></script>
</head>
<body>
<?php
	echo $library_src;
	echo $script_head;
	$this->jquery->toggle('test');
	// $this->jquery->click('me','alert(test)');
	// echo '<div id="me">click me</div>';
	?>
	
	
<div id='test'>click me please</div>
</body>
</html>