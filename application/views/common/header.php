<!DOCTYPE HTML SYSTEM "about:legacy-compat">
<html>
	<head>
		<meta charset="UTF-8">
		<title>Padi NEt</title>		
		
		<link type="text/css" href="<?php echo base_url();?>css/smoothness/jquery-ui-1.8.14.custom.css" rel="stylesheet" />	
		<link type="text/css" href="<?php echo base_url();?>css/padi_custom.css" rel="stylesheet" />	
		<script type="text/javascript" src="<?php echo base_url();?>js/jquery-1.5.1.min.js"></script>
		<script type="text/javascript" src="<?php echo base_url();?>js/jquery-ui-1.8.14.custom.min.js"></script>


		<script type="text/javascript">
			$(document).ready(function(){
				$("#tabs").tabs();
				$(".button").button();
				$('.table_button').button();
				$('.pagination a').button();
			})
		</script>
    </head>
	
	<body>
<!--		<div id="wrapper"> -->
		<div id='desc'>
			<?php if(isset($username)) {echo 'User Name: ' . $username . '<br>';} ?>
			<?php if(isset($row_count)){echo 'Row Count: ' . $row_count . '<br>';} ?>
		</div>
		<div id="container">
			<div id='logo'>
			<img src="/media/logo.png" /></div>
