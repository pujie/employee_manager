<?php
$header_data=array('username'=>$user_data->get_user());
$this->load->view('common/header',$header_data);
echo $title;
?>
<?php
$data=array('navigator'=>$this->user_data->get_navigator());
$this->load->view('common/footer',$data);
