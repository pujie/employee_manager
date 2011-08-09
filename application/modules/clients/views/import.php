<?php
$this->load->view('common/header');
?>
<html>
<head>
<title>Upload Form</title>
</head>
<body>
<div>Warning : before importing, the excel file should be placed in "root/upload" directory </div>
<?php
echo $this->lib_table_manager->create_table($this->user_data->get_navigator());
?>
</body>
</html>
<?php
$this->load->view('common/footer');
